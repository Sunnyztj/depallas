<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

// Theme storage
$LUXURY_WINE_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'essential-grid',
		'js_composer',
		'mailchimp-for-wp',
		'revslider',
		'woocommerce',
        'contact-form-7'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('luxury_wine_theme_setup1') ) {
	add_action( 'after_setup_theme', 'luxury_wine_theme_setup1', 1 );
	function luxury_wine_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'luxury-wine', luxury_wine_get_folder_dir('languages') );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'luxury_wine_filter_content_width', 1170 );
	}
}

if ( !function_exists('luxury_wine_theme_setup') ) {
	add_action( 'after_setup_theme', 'luxury_wine_theme_setup' );
	function luxury_wine_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('luxury_wine_filter_add_thumb_sizes', array(
			'luxury-wine-thumb-huge'		=> array(1170, 658, true),
			'luxury-wine-thumb-big' 		=> array( 760, 428, true),
			'luxury-wine-thumb-med' 		=> array( 370, 208, true),
			'luxury-wine-thumb-tiny' 		=> array(  90,  90, true),
			'luxury-wine-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'luxury-wine-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			'luxury-wine-thumb-classic'		=> array( 639, 534, true),	
			'luxury-wine-thumb-related'		=> array( 396, 280, true),	
			'luxury-wine-thumb-portrait'	=> array( 370, 450, true),
			'luxury-wine-thumb-creative'	=> array( 420, 364, true),
			)
		);
		$mult = luxury_wine_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'luxury_wine_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				luxury_wine_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			luxury_wine_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'luxury-wine'),
			'menu_mobile' => esc_html__('Mobile Menu', 'luxury-wine'),
			'menu_footer' => esc_html__('Footer Menu', 'luxury-wine')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'luxury_wine_excerpt_length' );
		add_filter( 'excerpt_more',							'luxury_wine_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'luxury_wine_wp_head', 1);
		
		// Add custom inline styles
		add_action('wp_footer',		 						'luxury_wine_wp_footer');
		add_action('admin_footer',	 						'luxury_wine_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'luxury_wine_wp_scripts', 1000);			//priority 1000 - load styles before the plugin's support custom styles (priority 1100)
		add_action('wp_footer',		 						'luxury_wine_localize_scripts');
		add_action('wp_enqueue_scripts', 					'luxury_wine_wp_scripts_responsive', 2000);	//priority 2000 - load responsive after all other styles
		
		// Add body classes
		add_filter( 'body_class',							'luxury_wine_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'luxury_wine_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'luxury_wine_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( !function_exists('luxury_wine_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'luxury_wine_image_sizes' );
	function luxury_wine_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('luxury_wine_filter_add_thumb_sizes', array(
			'luxury-wine-thumb-huge'		=> esc_html__( 'Fullsize image', 'luxury-wine' ),
			'luxury-wine-thumb-big'			=> esc_html__( 'Large image', 'luxury-wine' ),
			'luxury-wine-thumb-med'			=> esc_html__( 'Medium image', 'luxury-wine' ),
			'luxury-wine-thumb-tiny'		=> esc_html__( 'Small square avatar', 'luxury-wine' ),
			'luxury-wine-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'luxury-wine' ),
			'luxury-wine-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'luxury-wine' ),
			'luxury-wine-thumb-classic'		=> esc_html__( 'Classic', 'luxury-wine' ),
			'luxury-wine-thumb-related'		=> esc_html__( 'Related', 'luxury-wine' ),
			'luxury-wine-thumb-portrait'	=> esc_html__( 'Portrait', 'luxury-wine' ),
			'luxury-wine-thumb-creative'	=> esc_html__( 'Creative', 'luxury-wine' ),
			)
		);
		$mult = luxury_wine_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'luxury-wine' );
		}
		return $sizes;
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'luxury_wine_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'luxury_wine_wp_scripts', 1000);
	function luxury_wine_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = luxury_wine_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('luxury-wine-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello',  luxury_wine_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'luxury-wine-main', $main_stylesheet, array(), null );

		// Load child stylesheet (if different) after the main stylesheet and fontello icons (important!)
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'luxury-wine-child', $child_stylesheet, array('luxury-wine-main'), null );
		}

		// Add custom bg image for the body_style == 'boxed'
		if ( ($bg_image = luxury_wine_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'luxury-wine-main', '.page_wrap { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( luxury_wine_is_off(luxury_wine_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'luxury-wine-styles', luxury_wine_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && luxury_wine_is_off(luxury_wine_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'luxury-wine-colors', luxury_wine_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'luxury-wine-main', luxury_wine_customizer_get_css() );

		// Add post nav background
		luxury_wine_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(luxury_wine_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', luxury_wine_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', luxury_wine_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( luxury_wine_is_off(luxury_wine_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'luxury-wine-init', luxury_wine_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', luxury_wine_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = luxury_wine_get_header_video();
			if (!empty($header_video) && !luxury_wine_is_inherit($header_video))
				wp_enqueue_script( 'bideo', luxury_wine_get_file_url('js/bideo.js'), array(), null, true );
			// Theme scripts
			wp_enqueue_script( 'luxury-wine-utils', luxury_wine_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'luxury-wine-init', luxury_wine_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (luxury_wine_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'luxury_wine_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'luxury_wine_localize_scripts');
	function luxury_wine_localize_scripts() {

		$video = luxury_wine_get_header_video();

		wp_localize_script( 'luxury-wine-init', 'LUXURY_WINE_STORAGE', apply_filters( 'luxury_wine_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', luxury_wine_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
						
			// Sidemenu options
			'menu_side_stretch' => luxury_wine_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => luxury_wine_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => luxury_wine_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => luxury_wine_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'message_maxlength'	=> intval(luxury_wine_get_theme_setting('message_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'luxury-wine'),
					'error_global'		=> esc_html__('Error data validation!', 'luxury-wine'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'luxury-wine'),
					'name_long'			=> esc_html__('Too long name', 'luxury-wine'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'luxury-wine'),
					'email_long'		=> esc_html__('Too long email address', 'luxury-wine'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'luxury-wine'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'luxury-wine'),
					'text_long'			=> esc_html__('Too long message text', 'luxury-wine')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'luxury_wine_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'luxury_wine_wp_scripts_responsive', 2000);
	function luxury_wine_wp_scripts_responsive() {
		wp_enqueue_style( 'luxury-wine-responsive', luxury_wine_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('luxury_wine_wp_head')) {
	//Handler of the add_action('wp_head',	'luxury_wine_wp_head', 1);
	function luxury_wine_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('luxury_wine_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'luxury_wine_add_body_classes' );
	function luxury_wine_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(luxury_wine_get_theme_option('color_scheme'));

		$blog_mode = luxury_wine_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(luxury_wine_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(luxury_wine_get_theme_option('blog_style'));
			if (luxury_wine_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (luxury_wine_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(luxury_wine_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (luxury_wine_is_on(luxury_wine_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (luxury_wine_is_on(luxury_wine_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(luxury_wine_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(luxury_wine_get_theme_option("header_position"));

		$menu_style= luxury_wine_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load inline styles
if ( !function_exists( 'luxury_wine_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'luxury_wine_wp_footer');
	//and add_action('admin_footer', 'luxury_wine_wp_footer');
	function luxury_wine_wp_footer() {
		// Get inline styles from storage
		if (($css = luxury_wine_storage_get('inline_styles')) != '') {
			wp_enqueue_style(  'luxury-wine-inline-styles',  luxury_wine_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'luxury-wine-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('luxury_wine_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'luxury_wine_register_sidebars');
	function luxury_wine_register_sidebars() {
		$sidebars = luxury_wine_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => $sb['name'],
										'description'   => $sb['description'],
										'id'            => $id,
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h4 class="widget_title">',
										'after_title'   => '</h4>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('luxury_wine_get_sidebars') ) {
	function luxury_wine_get_sidebars() {
		$list = apply_filters('luxury_wine_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'luxury-wine'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'luxury-wine')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'luxury-wine'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'luxury-wine')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('luxury_wine_theme_fonts_links') ) {
	function luxury_wine_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== _x( 'on', 'Google fonts: on or off', 'luxury-wine' ) );
		$custom_fonts_enabled = ( 'off' !== _x( 'on', 'Custom fonts (included in the theme): on or off', 'luxury-wine' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !luxury_wine_storage_empty('load_fonts') ) {
			$load_fonts = luxury_wine_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = luxury_wine_get_load_fonts_slug($font['name']);
					$url  = luxury_wine_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', luxury_wine_get_protocol(), $google_fonts, luxury_wine_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('luxury_wine_theme_fonts_for_editor') ) {
	function luxury_wine_theme_fonts_for_editor() {
		$links = array_values(luxury_wine_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('luxury_wine_excerpt_length') ) {
	function luxury_wine_excerpt_length( $length ) {
		return max(1, luxury_wine_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('luxury_wine_excerpt_more') ) {
	function luxury_wine_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'luxury_wine_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'luxury_wine_importer_set_options', 9 );
	function luxury_wine_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(luxury_wine_get_protocol() . '://demofiles.themerex.net/luxurywine/');
			// Required plugins
			$options['required_plugins'] = luxury_wine_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Luxury Wine Demo', 'luxury-wine');
			$options['files']['default']['domain_dev'] = esc_url(luxury_wine_get_protocol().'://luxurywine.themerex.net');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(luxury_wine_get_protocol().'://luxurywine.themerex.net');		// Demo-site domain

		}
		return $options;
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'luxury_wine_comment_form_agree' ) ) {
    add_filter('comment_form_fields', 'luxury_wine_comment_form_agree', 11);
    function luxury_wine_comment_form_agree( $comment_fields ) {
        $privacy_text = luxury_wine_get_privacy_text();
        if ( ! empty( $privacy_text ) ) {
            $comment_fields['i_agree_privacy_policy'] = luxury_wine_single_comments_field(
                array(
                    'form_style'        => 'default',
                    'field_type'        => 'checkbox',
                    'field_req'         => '',
                    'field_icon'        => '',
                    'field_value'       => '1',
                    'field_name'        => 'i_agree_privacy_policy',
                    'field_title'       => $privacy_text,
                )
            );
        }
        return $comment_fields;
    }
}


//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once trailingslashit( get_template_directory() ) . 'includes/utils.php';
require_once trailingslashit( get_template_directory() ) . 'includes/storage.php';
require_once trailingslashit( get_template_directory() ) . 'includes/lists.php';
require_once trailingslashit( get_template_directory() ) . 'includes/wp.php';

if (is_admin()) {
	require_once trailingslashit( get_template_directory() ) . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/admin.php';
}

require_once trailingslashit( get_template_directory() ) . 'theme-options/theme.customizer.php';

require_once trailingslashit( get_template_directory() ) . 'theme-specific/trx_addons.php';

require_once trailingslashit( get_template_directory() ) . 'includes/theme.tags.php';
require_once trailingslashit( get_template_directory() ) . 'includes/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($LUXURY_WINE_STORAGE['required_plugins']) && count($LUXURY_WINE_STORAGE['required_plugins']) > 0) {
	foreach ($LUXURY_WINE_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = luxury_wine_esc($plugin_slug);
		$plugin_path = trailingslashit( get_template_directory() ) . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>