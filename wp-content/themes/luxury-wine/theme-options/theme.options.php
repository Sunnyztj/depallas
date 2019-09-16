<?php
/**
 * Default Theme Options and Internal Theme Settings
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('luxury_wine_options_theme_setup1') ) {
	add_action( 'after_setup_theme', 'luxury_wine_options_theme_setup1', 1 );
	function luxury_wine_options_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		luxury_wine_storage_set('settings', array(
			
			'ajax_views_counter'		=> true,						// Use AJAX for increment posts counter (if cache plugins used) 
																		// or increment posts counter then loading page (without cache plugin)
			'disable_jquery_ui'			=> false,						// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'max_load_fonts'			=> 3,							// Max fonts number to load from Google fonts or from uploaded fonts
		
			'use_mediaelements'			=> true,						// Load script "Media Elements" to play video and audio
		
			'max_excerpt_length'		=> 60,							// Max words number for the excerpt in the blog style 'Excerpt'.
																		// For style 'Classic' - get half from this value
			'message_maxlength'			=> 1000							// Max length of the message from contact form
			
		));
		
		
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		luxury_wine_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Roboto',
				'family' => 'sans-serif',
				'styles' => '300,300italic,400,400italic,700,700italic'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Lora',
				'family' => 'serif',
				'styles' => '400,400i,700,700i'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'   => 'Forum',
				'family' => 'cursive',
				'styles' => ''
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		luxury_wine_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		luxury_wine_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.8em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.8em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive',
				'font-size' 		=> '4rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '0.9166em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.04em',
				'margin-top'		=> '0.57em',
				'margin-bottom'		=> '0.57em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive',
				'font-size' 		=> '2rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.066em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.04em',
				'margin-top'		=> '0.76em',
				'margin-bottom'		=> '0.76em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive',
				'font-size' 		=> '1.8rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.148em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.04em',
				'margin-top'		=> '0.7879em',
				'margin-bottom'		=> '0.7879em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive',
				'font-size' 		=> '1.533rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.27em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.04em',
				'margin-top'		=> '0.7em',
				'margin-bottom'		=> '0.7em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive', 
				'font-size' 		=> '1.467rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.227em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.04em',
				'margin-top'		=> '0.75em',
				'margin-bottom'		=> '0.75em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'luxury-wine'),
				'font-family'		=> 'Forum, cursive',
				'font-size' 		=> '1.2rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.22em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '0.9412em',
				'margin-bottom'		=> '0.9412em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the main menu items', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.04em'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'luxury-wine'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'luxury-wine'),
				'font-family'		=> 'Lora, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0em'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		luxury_wine_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'luxury-wine'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',
					'bd_color'				=> '#d8d4be',
		
					// Text and links colors
					'text'					=> '#787567', 
					'text_light'			=> '#8a8996',  
					'text_dark'				=> '#23262c', 
					'text_link'				=> '#d03e3b', 
					'text_hover'			=> '#363440',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f5f5f7',
					'alter_bg_hover'		=> '#e6e8eb',
					'alter_bd_color'		=> '#d1c0b9',
					'alter_bd_hover'		=> '#d1c0b9',
					'alter_text'			=> '#787567',	
					'alter_light'			=> '#797070',	
					'alter_dark'			=> '#23262c',	
					'alter_link'			=> '#d03e3b',	
					'alter_hover'			=> '#d03e3b',	
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#ffffff',	
					'input_bg_hover'		=> '#faf7f5',	
					'input_bd_color'		=> '#eae8dd',	
					'input_bd_hover'		=> '#faf7f5',
					'input_text'			=> '#787567',
					'input_light'			=> '#837b78',
					'input_dark'			=> '#23262c',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',
					'inverse_light'			=> '#dcdad0',
					'inverse_dark'			=> '#ffffff',
					'inverse_link'			=> '#bdb68e',
					'inverse_hover'			=> '#ffffff',
		
					// Additional accented colors (if used in the current theme)
					// For example:
					'accent2'				=> '#0a2843',
					'accent2_hover'			=> '#7b6d1d',
					
					'button_bg_color'		=> '#d03e3b',	
					'button_bg_hover'		=> '#363440',   
					
					'simple_bg_hover'		=> '#d4c499', 
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'luxury-wine'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#23262c',
					'bd_color'				=> 'rgba(256,256,256,0.5)',
		
					// Text and links colors
					'text'					=> '#d5d4de',
					'text_light'			=> '#9d9d9d',	
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#d03e3b',
					'text_hover'			=> '#ffffff',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#23262c', 	
					'alter_bg_hover'		=> '#1f2126',	
					'alter_bd_color'		=> '#23262c',
					'alter_bd_hover'		=> '#23262c',	
					'alter_text'			=> '#d3d6d9',	
					'alter_light'			=> '#9f9f9f',	
					'alter_dark'			=> '#ffffff',	
					'alter_link'			=> '#d03e3b',	
					'alter_hover'			=> '#a48d82', 	
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#ffffff',
					'input_bg_hover'		=> '#faf7f5',
					'input_bd_color'		=> '#eae8dd',
					'input_bd_hover'		=> '#faf7f5',
					'input_text'			=> '#787567',
					'input_light'			=> '#837b78',
					'input_dark'			=> '#23262c',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',
					'inverse_light'			=> '#8a8996',
					'inverse_dark'			=> '#ffffff',
					'inverse_link'			=> '#bdb68e',
					'inverse_hover'			=> '#ffffff',
		
					// Additional accented colors (if used in the current theme)
					// For example:
					'accent2'				=> '#ffffff',
					'accent2_hover'			=> '#bdbbb1',
					
					'button_bg_color'		=> '#d03e3b',
					'button_bg_hover'		=> '#363440',
					
					'simple_bg_hover'		=> '#d03e3b', 
		
				)
			)
		
		));
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('luxury_wine_options_create')) {

	function luxury_wine_options_create() {

		luxury_wine_storage_set('options', array(
		
			// Section 'Title & Tagline' - add theme options in the standard WP section
			'title_tagline' => array(
				"title" => esc_html__('Title, Tagline & Site icon', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify site title and tagline (if need) and upload the site icon', 'luxury-wine') ),
				"type" => "section"
				),
		
		
			// Section 'Header' - add theme options in the standard WP section
			'header_image' => array(
				"title" => esc_html__('Header', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload logo images, select header type and widgets set for the header', 'luxury-wine') ),
				"type" => "section"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'luxury-wine'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'luxury-wine'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => 1,
				"type" => "checkbox"
				),
			'header_style' => array(
				"title" => esc_html__('Header style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select style to display the site header', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => 'header-default',
				"options" => luxury_wine_get_list_header_styles(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => 'default',
				"options" => luxury_wine_get_list_header_positions(),
				"type" => "select"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select color scheme to decorate header area', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo settings', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select logo images for the normal and Retina displays', 'luxury-wine') ),
				"type" => "info"
				),
			'logo' => array(
				"title" => esc_html__('Logo', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse' => array(
				"title" => esc_html__('Logo inverse', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it on the dark background', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_inverse_retina' => array(
				"title" => esc_html__('Logo inverse for Retina', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'logo_text' => array(
				"title" => esc_html__('Logo from Site name', 'luxury-wine'),
				"desc" => wp_kses_data( __('Do you want use Site name and description as Logo if images above are not selected?', 'luxury-wine') ),
				"std" => 1,
				"type" => "checkbox"
				),
			
		
		
			// Section 'Content'
			'content' => array(
				"title" => esc_html__('Content', 'luxury-wine'),
				"desc" => wp_kses_data( __('Options for the content area', 'luxury-wine') ),
				"type" => "section",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select width of the body content', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => array(
					'boxed'		=> esc_html__('Boxed',		'luxury-wine'),
					'wide'		=> esc_html__('Wide',		'luxury-wine'),
					'fullwide'	=> esc_html__('Fullwide',	'luxury-wine'),
					'fullscreen'=> esc_html__('Fullscreen',	'luxury-wine')
				),
				"type" => "select"
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select color scheme to decorate whole site. Attention! Case "Inherit" can be used only for custom pages, not for root site content in the Appearance - Customize', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"std" => 'default',
				"options" => luxury_wine_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'luxury-wine'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'luxury-wine'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Page bg image', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the body', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"std" => '',
				"type" => "image"
				),
			'no_image' => array(
				"title" => esc_html__('No image placeholder', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select or upload image, used as placeholder for the posts without featured image', 'luxury-wine') ),
				"std" => '',
				"type" => "image"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'luxury-wine')
				),
				"std" => 'sidebar_widgets',
				"options" => luxury_wine_get_list_sidebars(false, true),
				"type" => "select"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select color scheme to decorate sidebar', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'luxury-wine')
				),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'luxury-wine')
				),
				"refresh" => false,
				"std" => 'right',
				"options" => luxury_wine_get_list_sidebars_positions(),
				"type" => "select"
				),
			'hide_sidebar_on_single' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'luxury-wine'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'luxury-wine') ),
				"std" => 0,
				"type" => "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'luxury-wine'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'luxury-wine') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'luxury-wine') ),
                "type"  => "text"
            ),
		
		
			// Section 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select set of widgets and columns number for the site footer', 'luxury-wine') ),
				"type" => "section"
				),
			'footer_style' => array(
				"title" => esc_html__('Footer style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select style to display the site footer', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Footer', 'luxury-wine')
				),
				"std" => 'footer-default',
				"options" => apply_filters('luxury_wine_filter_list_footer_styles', array(
					'footer-default' => esc_html__('Default Footer',	'luxury-wine')
				)),
				"type" => "select"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'luxury-wine')
				),
				"std" => 'dark',
				"options" => luxury_wine_get_list_schemes(true),
				"refresh" => false,
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'luxury-wine')
				),
				"std" => 'footer_widgets',
				"options" => luxury_wine_get_list_sidebars(false, true),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'luxury-wine')
				),
				"dependency" => array(
					'footer_widgets' => array('^hide')
				),
				"std" => 4,
				"options" => luxury_wine_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'luxury-wine'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'luxury-wine')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'luxury-wine'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'luxury-wine') ),
				"std" => esc_html__('ThemeRex &copy; {Y}. All rights reserved. Terms of use and Privacy Policy', 'luxury-wine'),
				"refresh" => false,
				"type" => "textarea"
				),
		
		
		
			// Section 'Homepage' - settings for home page
			'homepage' => array(
				"title" => esc_html__('Homepage', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select blog style and widgets to display on the homepage', 'luxury-wine') ),
				"type" => "section"
				),
			'expand_content_home' => array(
				"title" => esc_html__('Expand content', 'luxury-wine'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the Homepage', 'luxury-wine') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style_home' => array(
				"title" => esc_html__('Blog style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select posts style for the homepage', 'luxury-wine') ),
				"std" => 'excerpt',
				"options" => luxury_wine_get_list_blog_styles(),
				"type" => "select"
				),
			'first_post_large_home' => array(
				"title" => esc_html__('First post large', 'luxury-wine'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of the Homepage', 'luxury-wine') ),
				"dependency" => array(
					'blog_style_home' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'header_style_home' => array(
				"title" => esc_html__('Header style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select style to display the site header on the homepage', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_header_styles(true),
				"type" => "select"
				),
			'header_position_home' => array(
				"title" => esc_html__('Header position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to display the site header on the homepage', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_header_positions(true),
				"type" => "select"
				),
			'sidebar_widgets_home' => array(
				"title" => esc_html__('Sidebar widgets', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select sidebar to show on the homepage', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_position_home' => array(
				"title" => esc_html__('Sidebar position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the homepage', 'luxury-wine') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => luxury_wine_get_list_sidebars_positions(true),
				"type" => "select"
				),
		
		
			// Section 'Blog archive'
			'blog' => array(
				"title" => esc_html__('Blog archive', 'luxury-wine'),
				"desc" => wp_kses_data( __('Options for the blog archive', 'luxury-wine') ),
				"type" => "section",
				),
			'expand_content_blog' => array(
				"title" => esc_html__('Expand content', 'luxury-wine'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden on the blog archive', 'luxury-wine') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),
			'blog_style' => array(
				"title" => esc_html__('Blog style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select posts style for the blog archive', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => 'excerpt',
				"options" => luxury_wine_get_list_blog_styles(),
				"type" => "select"
				),
			'blog_columns' => array(
				"title" => esc_html__('Blog columns', 'luxury-wine'),
				"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'luxury-wine') ),
				"std" => 2,
				"options" => luxury_wine_get_list_range(2,4),
				"type" => "hidden"
				),
			'post_type' => array(
				"title" => esc_html__('Post type', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"linked" => 'parent_cat',
				"refresh" => false,
				"hidden" => true,
				"std" => 'post',
				"options" => luxury_wine_get_list_posts_types(),
				"type" => "select"
				),
			'parent_cat' => array(
				"title" => esc_html__('Category to show', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select category to show in the blog archive', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"refresh" => false,
				"hidden" => true,
				"std" => '0',
				"options" => luxury_wine_array_merge(array(0 => esc_html__('- Select category -', 'luxury-wine')), luxury_wine_get_list_categories()),
				"type" => "select"
				),
			'posts_per_page' => array(
				"title" => esc_html__('Posts per page', 'luxury-wine'),
				"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"hidden" => true,
				"std" => '10',
				"type" => "text"
				),
			"blog_pagination" => array( 
				"title" => esc_html__('Pagination style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"std" => "links",
				"options" => array(
					'pages'	=> esc_html__("Page numbers", 'luxury-wine'),
					'links'	=> esc_html__("Older/Newest", 'luxury-wine'),
					'more'	=> esc_html__("Load more", 'luxury-wine'),
					'infinite' => esc_html__("Infinite scroll", 'luxury-wine')
				),
				"type" => "select"
				),
			'show_filters' => array(
				"title" => esc_html__('Show filters', 'luxury-wine'),
				"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
					'blog_style' => array('portfolio', 'gallery')
				),
				"hidden" => true,
				"std" => 0,
				"type" => "checkbox"
				),
			'first_post_large' => array(
				"title" => esc_html__('First post large', 'luxury-wine'),
				"desc" => wp_kses_data( __('Make first post large (with Excerpt layout) on the Classic layout of blog archive', 'luxury-wine') ),
				"dependency" => array(
					'blog_style' => array('classic')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			"blog_content" => array( 
				"title" => esc_html__('Posts content', 'luxury-wine'),
				"desc" => wp_kses_data( __("Show full post's content in the blog or only post's excerpt", 'luxury-wine') ),
				"std" => "excerpt",
				"options" => array(
					'excerpt'	=> esc_html__('Excerpt',	'luxury-wine'),
					'fullpost'	=> esc_html__('Full post',	'luxury-wine')
				),
				"type" => "select"
				),
			'time_diff_before' => array(
				"title" => esc_html__('Time difference', 'luxury-wine'),
				"desc" => wp_kses_data( __("How many days show time difference instead post's date", 'luxury-wine') ),
				"std" => 5,
				"type" => "text"
				),
			'related_posts' => array(
				"title" => esc_html__('Related posts', 'luxury-wine'),
				"desc" => wp_kses_data( __('How many related posts should be displayed in the single post?', 'luxury-wine') ),
				"std" => 2,
				"options" => luxury_wine_get_list_range(2,4),
				"type" => "select"
				),
			'related_style' => array(
				"title" => esc_html__('Related posts style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select style of the related posts output', 'luxury-wine') ),
				"std" => 2,
				"options" => luxury_wine_get_list_styles(1,2),
				"type" => "select"
				),
			"blog_animation" => array( 
				"title" => esc_html__('Animation for the posts', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'luxury-wine')
				),
				"dependency" => array(
                    '#page_template' => array( 'blog.php' ),
                    '.editor-page-attributes__template select' => array( 'blog.php' ),
				),
				"std" => "none",
				"options" => luxury_wine_get_list_animations_in(),
				"type" => "select"
				),
			'header_style_blog' => array(
				"title" => esc_html__('Header style', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select style to display the site header on the blog archive', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_header_styles(true),
				"type" => "select"
				),
			'header_position_blog' => array(
				"title" => esc_html__('Header position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to display the site header on the blog archive', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_header_positions(true),
				"type" => "select"
				),
			'sidebar_widgets_blog' => array(
				"title" => esc_html__('Sidebar widgets', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select sidebar to show on the blog archive', 'luxury-wine') ),
				"std" => 'inherit',
				"options" => luxury_wine_get_list_sidebars(true, true),
				"type" => "select"
				),
			'sidebar_position_blog' => array(
				"title" => esc_html__('Sidebar position', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select position to show sidebar on the blog archive', 'luxury-wine') ),
				"refresh" => false,
				"std" => 'inherit',
				"options" => luxury_wine_get_list_sidebars_positions(true),
				"type" => "select"
				),
			'hide_sidebar_on_single_blog' => array(
				"title" => esc_html__('Hide sidebar on the single post', 'luxury-wine'),
				"desc" => wp_kses_data( __("Hide sidebar on the single post", 'luxury-wine') ),
				"std" => 0,
				"type" => "checkbox"
				),
			
		
		
		
			// Section 'Colors' - choose color scheme and customize separate colors from it
			'scheme' => array(
				"title" => esc_html__('* Color scheme editor', 'luxury-wine'),
				"desc" => wp_kses_data( __("<b>Simple settings</b> - you can change only accented color, used for links, buttons and some accented areas.", 'luxury-wine') )
						. '<br>'
						. wp_kses_data( __("<b>Advanced settings</b> - change all scheme's colors and get full control over the appearance of your site!", 'luxury-wine') ),
				"priority" => 1000,
				"type" => "section"
				),
		
			'color_settings' => array(
				"title" => esc_html__('Color settings', 'luxury-wine'),
				"desc" => '',
				"std" => 'simple',
				"options" => array(
					"simple"  => esc_html__("Simple", 'luxury-wine'),
					"advanced" => esc_html__("Advanced", 'luxury-wine')
				),
				"refresh" => false,
				"type" => "switch"
				),
		
			'color_scheme_editor' => array(
				"title" => esc_html__('Color Scheme', 'luxury-wine'),
				"desc" => wp_kses_data( __('Select color scheme to edit colors', 'luxury-wine') ),
				"std" => 'default',
				"options" => luxury_wine_get_list_schemes(),
				"refresh" => false,
				"type" => "select"
				),
		
			'scheme_storage' => array(
				"title" => esc_html__('Colors storage', 'luxury-wine'),
				"desc" => esc_html__('Hidden storage of the all color from the all color shemes (only for internal usage)', 'luxury-wine'),
				"std" => '',
				"refresh" => false,
				"type" => "hidden"
				),
		
			'scheme_info_single' => array(
				"title" => esc_html__('Colors for single post/page', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify colors for single post/page (not for alter blocks)', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
				
			'bg_color' => array(
				"title" => esc_html__('Background color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Background color of the whole page', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'bd_color' => array(
				"title" => esc_html__('Border color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the bordered elements, separators, etc.', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'text' => array(
				"title" => esc_html__('Text', 'luxury-wine'),
				"desc" => wp_kses_data( __('Plain text color on single page/post', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_light' => array(
				"title" => esc_html__('Light text', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the post meta: post date and author, comments number, etc.', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_dark' => array(
				"title" => esc_html__('Dark text', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the headers, strong text, etc.', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_link' => array(
				"title" => esc_html__('Links', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of links and accented areas', 'luxury-wine') ),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'text_hover' => array(
				"title" => esc_html__('Links hover', 'luxury-wine'),
				"desc" => wp_kses_data( __('Hover color for links and accented areas', 'luxury-wine') ),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_alter' => array(
				"title" => esc_html__('Colors for alternative blocks', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify colors for alternative blocks - rectangular blocks with its own background color (posts in homepage, blog archive, search results, widgets on sidebar, footer, etc.)', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'alter_bg_color' => array(
				"title" => esc_html__('Alter background color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Background color of the alternative blocks', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bg_hover' => array(
				"title" => esc_html__('Alter hovered background color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Background color for the hovered state of the alternative blocks', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_color' => array(
				"title" => esc_html__('Alternative border color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Border color of the alternative blocks', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_bd_hover' => array(
				"title" => esc_html__('Alternative hovered border color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Border color for the hovered state of the alter blocks', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_text' => array(
				"title" => esc_html__('Alter text', 'luxury-wine'),
				"desc" => wp_kses_data( __('Text color of the alternative blocks', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_light' => array(
				"title" => esc_html__('Alter light', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with alternative background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_dark' => array(
				"title" => esc_html__('Alter dark', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the headers inside block with alternative background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_link' => array(
				"title" => esc_html__('Alter link', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the links inside block with alternative background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'alter_hover' => array(
				"title" => esc_html__('Alter hover', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with alternative background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_input' => array(
				"title" => esc_html__('Colors for the form fields', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify colors for the form fields and textareas', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'input_bg_color' => array(
				"title" => esc_html__('Inactive background', 'luxury-wine'),
				"desc" => wp_kses_data( __('Background color of the inactive form fields', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bg_hover' => array(
				"title" => esc_html__('Active background', 'luxury-wine'),
				"desc" => wp_kses_data( __('Background color of the focused form fields', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_color' => array(
				"title" => esc_html__('Inactive border', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the border in the inactive form fields', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_bd_hover' => array(
				"title" => esc_html__('Active border', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the border in the focused form fields', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_text' => array(
				"title" => esc_html__('Inactive field', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the text in the inactive fields', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_light' => array(
				"title" => esc_html__('Disabled field', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the disabled field', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'input_dark' => array(
				"title" => esc_html__('Active field', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the active field', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
		
			'scheme_info_inverse' => array(
				"title" => esc_html__('Colors for inverse blocks', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify colors for inverse blocks, rectangular blocks with background color equal to the links color or one of accented colors (if used in the current theme)', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),
		
			'inverse_text' => array(
				"title" => esc_html__('Inverse text', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the text inside block with accented background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_light' => array(
				"title" => esc_html__('Inverse light', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the info blocks inside block with accented background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_dark' => array(
				"title" => esc_html__('Inverse dark', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the headers inside block with accented background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_link' => array(
				"title" => esc_html__('Inverse link', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the links inside block with accented background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'inverse_hover' => array(
				"title" => esc_html__('Inverse hover', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of the hovered links inside block with accented background', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'scheme_info_additional' => array(
				"title" => esc_html__('Additional colors', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify colors for accent blocks, buttons and socials', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"type" => "info"
				),	
			'accent2' => array(
				"title" => esc_html__('Accent color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of accented areas', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'accent2_hover' => array(
				"title" => esc_html__('Accent hover', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of hovered accented areas', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'button_bg_color' => array(
				"title" => esc_html__('Button color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of buttons', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'button_bg_hover' => array(
				"title" => esc_html__('Button hover', 'luxury-wine'),
				"desc" => wp_kses_data( __('Color of hovered buttons', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),
			'simple_bg_hover' => array(
				"title" => esc_html__('Additional color', 'luxury-wine'),
				"desc" => wp_kses_data( __('Used for socials icons in the footer', 'luxury-wine') ),
				"dependency" => array(
					'color_settings' => array('^simple')
				),
				"std" => '$luxury_wine_get_scheme_color',
				"refresh" => false,
				"type" => "color"
				),


			// Section 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'luxury-wine'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'luxury-wine') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'luxury-wine')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'luxury-wine'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'luxury-wine') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Title', 'luxury-wine')
				),
				"hidden" => true,
				"std" => '',
				"type" => "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// Panel 'Fonts' - manage fonts loading and set parameters of the base theme elements
			'fonts' => array(
				"title" => esc_html__('* Fonts settings', 'luxury-wine'),
				"desc" => '',
				"priority" => 1500,
				"type" => "panel"
				),

			// Section 'Load_fonts'
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'luxury-wine') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'luxury-wine') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'luxury-wine'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'luxury-wine') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'luxury-wine') ),
				"refresh" => false,
				"std" => '$luxury_wine_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=luxury_wine_get_theme_setting('max_load_fonts'); $i++) {
			$fonts["load_fonts-{$i}-info"] = array(
				"title" => esc_html(sprintf(esc_html__('Font %s', 'luxury-wine'), $i)),
				"desc" => '',
				"type" => "info",
				);
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'luxury-wine'),
				"desc" => '',
				"refresh" => false,
				"std" => '$luxury_wine_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'luxury-wine'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'luxury-wine') )
							: '',
				"refresh" => false,
				"std" => '$luxury_wine_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'luxury-wine'),
					'serif' => esc_html__('serif', 'luxury-wine'),
					'sans-serif' => esc_html__('sans-serif', 'luxury-wine'),
					'monospace' => esc_html__('monospace', 'luxury-wine'),
					'cursive' => esc_html__('cursive', 'luxury-wine'),
					'fantasy' => esc_html__('fantasy', 'luxury-wine')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'luxury-wine'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'luxury-wine') )
											. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'luxury-wine') )
							: '',
				"refresh" => false,
				"std" => '$luxury_wine_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Sections with font's attributes for each theme element
		$theme_fonts = luxury_wine_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								: esc_html(sprintf(esc_html__('%s settings', 'luxury-wine'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								: wp_kses_post( sprintf(esc_html__('Font settings of the "%s" tag.', 'luxury-wine'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = luxury_wine_get_list_load_fonts(true);
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'luxury-wine'),
						'100' => esc_html__('100 (Light)', 'luxury-wine'), 
						'200' => esc_html__('200 (Light)', 'luxury-wine'), 
						'300' => esc_html__('300 (Thin)',  'luxury-wine'),
						'400' => esc_html__('400 (Normal)', 'luxury-wine'),
						'500' => esc_html__('500 (Semibold)', 'luxury-wine'),
						'600' => esc_html__('600 (Semibold)', 'luxury-wine'),
						'700' => esc_html__('700 (Bold)', 'luxury-wine'),
						'800' => esc_html__('800 (Black)', 'luxury-wine'),
						'900' => esc_html__('900 (Black)', 'luxury-wine')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'luxury-wine'),
						'normal' => esc_html__('Normal', 'luxury-wine'), 
						'italic' => esc_html__('Italic', 'luxury-wine')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'luxury-wine'),
						'none' => esc_html__('None', 'luxury-wine'), 
						'underline' => esc_html__('Underline', 'luxury-wine'),
						'overline' => esc_html__('Overline', 'luxury-wine'),
						'line-through' => esc_html__('Line-through', 'luxury-wine')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'luxury-wine'),
						'none' => esc_html__('None', 'luxury-wine'), 
						'uppercase' => esc_html__('Uppercase', 'luxury-wine'),
						'lowercase' => esc_html__('Lowercase', 'luxury-wine'),
						'capitalize' => esc_html__('Capitalize', 'luxury-wine')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"refresh" => false,
					"std" => '$luxury_wine_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters into Theme Options
		luxury_wine_storage_merge_array('options', '', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			luxury_wine_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'luxury-wine'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'luxury-wine') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'luxury-wine')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}
	}
}




// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if (!function_exists('luxury_wine_options_theme_setup2')) {
	add_action( 'after_setup_theme', 'luxury_wine_options_theme_setup2', 2 );
	function luxury_wine_options_theme_setup2() {
		luxury_wine_options_create();
	}
}

// Step 1: Load default settings and previously saved mods
if (!function_exists('luxury_wine_options_theme_setup5')) {
	add_action( 'after_setup_theme', 'luxury_wine_options_theme_setup5', 5 );
	function luxury_wine_options_theme_setup5() {
		luxury_wine_storage_set('options_reloaded', false);
		luxury_wine_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if (is_customize_preview()) {
	if (!function_exists('luxury_wine_load_custom_options')) {
		add_action( 'wp_loaded', 'luxury_wine_load_custom_options' );
		function luxury_wine_load_custom_options() {
			if (!luxury_wine_storage_get('options_reloaded')) {
				luxury_wine_storage_set('options_reloaded', true);
				luxury_wine_load_theme_options();
			}
		}
	}
}

// Load current values for each customizable option
if ( !function_exists('luxury_wine_load_theme_options') ) {
	function luxury_wine_load_theme_options() {
		$options = luxury_wine_storage_get('options');
		$reset = (int) get_theme_mod('reset_options', 0);
		foreach ($options as $k=>$v) {
			if (isset($v['std'])) {
				if (strpos($v['std'], '$luxury_wine_')!==false) {
					$func = substr($v['std'], 1);
					if (function_exists($func)) {
						$v['std'] = $func($k);
					}
				}
				$value = $v['std'];
				if (!$reset) {
					if (isset($_GET[$k]))
						$value = $_GET[$k];
					else {
						$tmp = get_theme_mod($k, -987654321);
						if ($tmp != -987654321) $value = $tmp;
					}
				}
				luxury_wine_storage_set_array2('options', $k, 'val', $value);
				if ($reset) remove_theme_mod($k);
			}
		}
		if ($reset) {
			// Unset reset flag
			set_theme_mod('reset_options', 0);
			// Regenerate CSS with default colors and fonts
			luxury_wine_customizer_save_css();
		} else {
			do_action('luxury_wine_action_load_options');
		}
	}
}

// Override options with stored page/post meta
if ( !function_exists('luxury_wine_override_theme_options') ) {
	add_action( 'wp', 'luxury_wine_override_theme_options', 1 );
	function luxury_wine_override_theme_options($query=null) {
		if (is_page_template('blog.php')) {
			luxury_wine_storage_set('blog_archive', true);
			luxury_wine_storage_set('blog_template', get_the_ID());
		}
		luxury_wine_storage_set('blog_mode', luxury_wine_detect_blog_mode());
		if (is_singular()) {
			luxury_wine_storage_set('options_meta', get_post_meta(get_the_ID(), 'luxury_wine_options', true));
		}
	}
}


// Return customizable option value
if (!function_exists('luxury_wine_get_theme_option')) {
	function luxury_wine_get_theme_option($name, $defa='', $strict_mode=false, $post_id=0) {
		$rez = $defa;
		$from_post_meta = false;
		if ($post_id > 0) {
			if (!luxury_wine_storage_isset('post_options_meta', $post_id))
				luxury_wine_storage_set_array('post_options_meta', $post_id, get_post_meta($post_id, 'luxury_wine_options', true));
			if (luxury_wine_storage_isset('post_options_meta', $post_id, $name)) {
				$tmp = luxury_wine_storage_get_array('post_options_meta', $post_id, $name);
				if (!luxury_wine_is_inherit($tmp)) {
					$rez = $tmp;
					$from_post_meta = true;
				}
			}
		}
		if (!$from_post_meta && luxury_wine_storage_isset('options')) {
			if ( !luxury_wine_storage_isset('options', $name) ) {
				$rez = $tmp = '_not_exists_';
				if (function_exists('trx_addons_get_option'))
					$rez = trx_addons_get_option($name, $tmp, false);
				if ($rez === $tmp) {
					if ($strict_mode) {
						$s = debug_backtrace();
						$s = array_shift($s);
						echo '<pre>' . sprintf(esc_html__('Undefined option "%s" called from:', 'luxury-wine'), $name);
						if (function_exists('dco')) dco($s);
						else print_r($s);
						echo '</pre>';
                        wp_die();
					} else
						$rez = $defa;
				}
			} else {
				$blog_mode = luxury_wine_storage_get('blog_mode');
				// Override option from GET or POST for current blog mode
				if (!empty($blog_mode) && isset($_REQUEST[$name . '_' . $blog_mode])) {
					$rez = $_REQUEST[$name . '_' . $blog_mode];
				// Override option from GET
				} else if (isset($_REQUEST[$name])) {
					$rez = $_REQUEST[$name];
				// Override option from current page settings (if exists)
				} else if (luxury_wine_storage_isset('options_meta', $name) && !luxury_wine_is_inherit(luxury_wine_storage_get_array('options_meta', $name))) {
					$rez = luxury_wine_storage_get_array('options_meta', $name);
				// Override option from current blog mode settings: 'home', 'search', 'page', 'post', 'blog', etc. (if exists)
				} else if (!empty($blog_mode) && luxury_wine_storage_isset('options', $name . '_' . $blog_mode, 'val') && !luxury_wine_is_inherit(luxury_wine_storage_get_array('options', $name . '_' . $blog_mode, 'val'))) {
					$rez = luxury_wine_storage_get_array('options', $name . '_' . $blog_mode, 'val');
				// Get saved option value
				} else if (luxury_wine_storage_isset('options', $name, 'val')) {
					$rez = luxury_wine_storage_get_array('options', $name, 'val');
				// Get ThemeREX Addons option value
				} else if (function_exists('trx_addons_get_option')) {
					$rez = trx_addons_get_option($name, $defa, false);
				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if (!function_exists('luxury_wine_check_theme_option')) {
	function luxury_wine_check_theme_option($name) {
		return luxury_wine_storage_isset('options', $name);
	}
}

// Get dependencies list from the Theme Options
if ( !function_exists('luxury_wine_get_theme_dependencies') ) {
	function luxury_wine_get_theme_dependencies() {
		$options = luxury_wine_storage_get('options');
		$depends = array();
		foreach ($options as $k=>$v) {
			if (isset($v['dependency'])) 
				$depends[$k] = $v['dependency'];
		}
		return $depends;
	}
}

// Return internal theme setting value
if (!function_exists('luxury_wine_get_theme_setting')) {
	function luxury_wine_get_theme_setting($name) {
		return luxury_wine_storage_isset('settings', $name) ? luxury_wine_storage_get_array('settings', $name) : false;
	}
}


// Set theme setting
if ( !function_exists( 'luxury_wine_set_theme_setting' ) ) {
	function luxury_wine_set_theme_setting($option_name, $value) {
		if (luxury_wine_storage_isset('settings', $option_name))
			luxury_wine_storage_set_array('settings', $option_name, $value);
	}
}
?>