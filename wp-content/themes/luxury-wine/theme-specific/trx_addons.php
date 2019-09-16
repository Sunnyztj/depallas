<?php
/* Theme-specific action to configure ThemeREX Addons components
------------------------------------------------------------------------------- */


/* ThemeREX Addons components
------------------------------------------------------------------------------- */

if (!function_exists('luxury_wine_trx_addons_theme_specific_setup1')) {
	add_action( 'after_setup_theme', 'luxury_wine_trx_addons_theme_specific_setup1', 1 );
	add_action( 'trx_addons_action_save_options', 'luxury_wine_trx_addons_theme_specific_setup1', 8 );
	function luxury_wine_trx_addons_theme_specific_setup1() {
		if (luxury_wine_exists_trx_addons()) {
			add_filter( 'trx_addons_cv_enable',				'luxury_wine_trx_addons_cv_enable');
			add_filter( 'trx_addons_cpt_list',				'luxury_wine_trx_addons_cpt_list');
			add_filter( 'trx_addons_sc_list',				'luxury_wine_trx_addons_sc_list');
			add_filter( 'trx_addons_widgets_list',			'luxury_wine_trx_addons_widgets_list');
		}
	}
}

// CV
if ( !function_exists( 'luxury_wine_trx_addons_cv_enable' ) ) {
	//Handler of the add_filter( 'trx_addons_cv_enable', 'luxury_wine_trx_addons_cv_enable');
	function luxury_wine_trx_addons_cv_enable($enable=false) {
		// To do: return false if theme not use CV functionality
		return true;
	}
}

// CPT
if ( !function_exists( 'luxury_wine_trx_addons_cpt_list' ) ) {
	//Handler of the add_filter('trx_addons_cpt_list',	'luxury_wine_trx_addons_cpt_list');
	function luxury_wine_trx_addons_cpt_list($list=array()) {
		// To do: Enable/Disable CPT via add/remove it in the list
		return $list;
	}
}

// Shortcodes
if ( !function_exists( 'luxury_wine_trx_addons_sc_list' ) ) {
	//Handler of the add_filter('trx_addons_sc_list',	'luxury_wine_trx_addons_sc_list');
	function luxury_wine_trx_addons_sc_list($list=array()) {
		// To do: Add/Remove shortcodes into list
		// If you add new shortcode - in the theme's folder must exists /trx_addons/shortcodes/new_sc_name/new_sc_name.php
		return $list;
	}
}

// Widgets
if ( !function_exists( 'luxury_wine_trx_addons_widgets_list' ) ) {
	//Handler of the add_filter('trx_addons_widgets_list',	'luxury_wine_trx_addons_widgets_list');
	function luxury_wine_trx_addons_widgets_list($list=array()) {
		// To do: Add/Remove widgets into list
		// If you add widget - in the theme's folder must exists /trx_addons/widgets/new_widget_name/new_widget_name.php
		return $list;
	}
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('luxury_wine_trx_addons_theme_specific_setup3')) {
	add_action( 'after_setup_theme', 'luxury_wine_trx_addons_theme_specific_setup3', 3 );
	function luxury_wine_trx_addons_theme_specific_setup3() {
		
		// Section 'Courses' - settings to show 'Courses' blog archive and single posts
		if (luxury_wine_exists_courses()) {
			luxury_wine_storage_merge_array('options', '', array(
				'courses' => array(
					"title" => esc_html__('Courses', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select parameters to display the courses pages', 'luxury-wine') ),
					"type" => "section"
					),
				'expand_content_courses' => array(
					"title" => esc_html__('Expand content', 'luxury-wine'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'luxury-wine') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_courses' => array(
					"title" => esc_html__('Header style', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select style to display the site header on the courses pages', 'luxury-wine') ),
					"std" => 'inherit',
					"options" => luxury_wine_get_list_header_styles(true),
					"type" => "select"
					),
				'header_position_courses' => array(
					"title" => esc_html__('Header position', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select position to display the site header on the courses pages', 'luxury-wine') ),
					"std" => 'inherit',
					"options" => luxury_wine_get_list_header_positions(true),
					"type" => "select"
					),
				'header_widgets_courses' => array(
					"title" => esc_html__('Header widgets', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the courses pages', 'luxury-wine') ),
					"std" => 'hide',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'sidebar_widgets_courses' => array(
					"title" => esc_html__('Sidebar widgets', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select sidebar to show on the courses pages', 'luxury-wine') ),
					"std" => 'courses_widgets',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'sidebar_position_courses' => array(
					"title" => esc_html__('Sidebar position', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the courses pages', 'luxury-wine') ),
					"refresh" => false,
					"std" => 'left',
					"options" => luxury_wine_get_list_sidebars_positions(true),
					"type" => "select"
					),
				'hide_sidebar_on_single_courses' => array(
					"title" => esc_html__('Hide sidebar on the single course', 'luxury-wine'),
					"desc" => wp_kses_data( __("Hide sidebar on the single course's page", 'luxury-wine') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_courses' => array(
					"title" => esc_html__('Widgets above the page', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select widgets to show above page (content and sidebar)', 'luxury-wine') ),
					"std" => 'hide',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_above_content_courses' => array(
					"title" => esc_html__('Widgets above the content', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'luxury-wine') ),
					"std" => 'hide',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_below_content_courses' => array(
					"title" => esc_html__('Widgets below the content', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'luxury-wine') ),
					"std" => 'hide',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'widgets_below_page_courses' => array(
					"title" => esc_html__('Widgets below the page', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select widgets to show below the page (content and sidebar)', 'luxury-wine') ),
					"std" => 'hide',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'footer_scheme_courses' => array(
					"title" => esc_html__('Footer Color Scheme', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'luxury-wine') ),
					"std" => 'dark',
					"options" => luxury_wine_get_list_schemes(true),
					"type" => "select"
					),
				'footer_widgets_courses' => array(
					"title" => esc_html__('Footer widgets', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'luxury-wine') ),
					"std" => 'footer_widgets',
					"options" => luxury_wine_get_list_sidebars(true, true),
					"type" => "select"
					),
				'footer_columns_courses' => array(
					"title" => esc_html__('Footer columns', 'luxury-wine'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'luxury-wine') ),
					"dependency" => array(
						'footer_widgets_courses' => array('^hide')
					),
					"std" => 0,
					"options" => luxury_wine_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_courses' => array(
					"title" => esc_html__('Footer fullwide', 'luxury-wine'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'luxury-wine') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Add mobile menu to the plugin's cached menu list
if ( !function_exists( 'luxury_wine_trx_addons_menu_cache' ) ) {
	add_filter( 'trx_addons_filter_menu_cache', 'luxury_wine_trx_addons_menu_cache');
	function luxury_wine_trx_addons_menu_cache($list=array()) {
		if (in_array('#menu_main', $list)) $list[] = '#menu_mobile';
		return $list;
	}
}

// Add vars into localize array
if (!function_exists('luxury_wine_trx_addons_localize_script')) {
	add_filter( 'luxury_wine_filter_localize_script','luxury_wine_trx_addons_localize_script' );
	function luxury_wine_trx_addons_localize_script($arr) {
		$arr['alter_link_color'] = luxury_wine_get_scheme_color('alter_link');
		return $arr;
	}
}


// Add theme-specific layouts to the list
if (!function_exists('luxury_wine_trx_addons_theme_specific_default_layouts')) {
	add_filter( 'trx_addons_filter_default_layouts',	'luxury_wine_trx_addons_theme_specific_default_layouts');
	function luxury_wine_trx_addons_theme_specific_default_layouts($default_layouts=array()) {
		require_once 'trx_addons.layouts.php';
		return isset($layouts) && is_array($layouts) && count($layouts) > 0
						? array_merge($default_layouts, $layouts)
						: $default_layouts;
	}
}

// Disable override header image on team pages
if ( !function_exists( 'luxury_wine_trx_addons_allow_override_header_image' ) ) {
	add_filter( 'luxury_wine_filter_allow_override_header_image', 'luxury_wine_trx_addons_allow_override_header_image' );
	function luxury_wine_trx_addons_allow_override_header_image($allow) {
		return luxury_wine_is_team_page() || luxury_wine_is_portfolio_page() ? false : $allow;
	}
}

// Hide sidebar on the team pages
if ( !function_exists( 'luxury_wine_trx_addons_sidebar_present' ) ) {
	add_filter( 'luxury_wine_filter_sidebar_present', 'luxury_wine_trx_addons_sidebar_present' );
	function luxury_wine_trx_addons_sidebar_present($present) {
		return !is_single() && (luxury_wine_is_team_page() || luxury_wine_is_portfolio_page()) ? false : $present;
	}
}


// WP Editor addons
//------------------------------------------------------------------------

// Theme-specific configure of the WP Editor
if ( !function_exists( 'luxury_wine_trx_addons_editor_init' ) ) {
	if (is_admin()) add_filter( 'tiny_mce_before_init', 'luxury_wine_trx_addons_editor_init', 11);
	function luxury_wine_trx_addons_editor_init($opt) {
		if (luxury_wine_exists_trx_addons()) {
			// Add style 'Arrow' to the 'List styles'
			// Remove 'false &&' from condition below to add new style to the list
			if (false && !empty($opt['style_formats'])) {
				$style_formats = json_decode($opt['style_formats'], true);
				if (is_array($style_formats) && count($style_formats)>0 ) {
					foreach ($style_formats as $k=>$v) {
						if ( $v['title'] == esc_html__('List styles', 'luxury-wine') ) {
							$style_formats[$k]['items'][] = array(
										'title' => esc_html__('Arrow', 'luxury-wine'),
										'selector' => 'ul',
										'classes' => 'trx_addons_list trx_addons_list_arrow'
									);
						}
					}
					$opt['style_formats'] = json_encode( $style_formats );		
				}
			}
		}
		return $opt;
	}
}


// Theme-specific thumb sizes
//------------------------------------------------------------------------

// Replace thumb sizes to the theme-specific
if ( !function_exists( 'luxury_wine_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'luxury_wine_trx_addons_add_thumb_sizes');
	function luxury_wine_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								'trx_addons-thumb-classic',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// Return theme-specific thumb size instead removed plugin's thumb size
if ( !function_exists( 'luxury_wine_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'luxury_wine_trx_addons_get_thumb_size');
	function luxury_wine_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							'trx_addons-thumb-classic',
							'trx_addons-thumb-classic-@retina',
							'trx_addons-thumb-related',
							'trx_addons-thumb-related-@retina',
							'trx_addons-thumb-portrait',
							'trx_addons-thumb-portrait-@retina',
							'trx_addons-thumb-creative',
							'trx_addons-thumb-creative-@retina',
							),
							array(
							'luxury-wine-thumb-huge',
							'luxury-wine-thumb-huge-@retina',
							'luxury-wine-thumb-big',
							'luxury-wine-thumb-big-@retina',
							'luxury-wine-thumb-med',
							'luxury-wine-thumb-med-@retina',
							'luxury-wine-thumb-tiny',
							'luxury-wine-thumb-tiny-@retina',
							'luxury-wine-thumb-masonry-big',
							'luxury-wine-thumb-masonry-big-@retina',
							'luxury-wine-thumb-masonry',
							'luxury-wine-thumb-masonry-@retina',
							'luxury-wine-thumb-classic',
							'luxury-wine-thumb-classic-@retina',
							'luxury-wine-thumb-related',
							'luxury-wine-thumb-related-@retina',
							'luxury-wine-thumb-portrait',
							'luxury-wine-thumb-portrait-@retina',
							'luxury-wine-thumb-creative',
							'luxury-wine-thumb-creative-@retina',
							),
							$thumb_size);
	}
}

// Get thumb size for the team items
if ( !function_exists( 'luxury_wine_trx_addons_team_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_team_thumb_size',	'luxury_wine_trx_addons_team_thumb_size', 10, 2);
	function luxury_wine_trx_addons_team_thumb_size($thumb_size='', $team_type='') {
		return $team_type == 'default' ? luxury_wine_get_thumb_size('portrait') : $thumb_size;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Return tag for the item's title
if ( !function_exists( 'luxury_wine_trx_addons_sc_item_title_tag' ) ) {
	add_filter( 'trx_addons_filter_sc_item_title_tag', 'luxury_wine_trx_addons_sc_item_title_tag');
	function luxury_wine_trx_addons_sc_item_title_tag($tag='') {
		return $tag=='h1' ? 'h2' : $tag;
	}
}

// Return args for the item's button
if ( !function_exists( 'luxury_wine_trx_addons_sc_item_button_args' ) ) {
	add_filter( 'trx_addons_filter_sc_item_button_args', 'luxury_wine_trx_addons_sc_item_button_args');
	function luxury_wine_trx_addons_sc_item_button_args($args, $sc='') {
		if (false && $sc != 'sc_button') {
			$args['type'] = 'simple';
			$args['size'] = 'small';
			$args['icon_type'] = 'fontawesome';
			$args['icon_fontawesome'] = 'icon-down-big';
			$args['icon_position'] = 'top';
		}
		return $args;
	}
}

// Add new types in the shortcodes
if ( !function_exists( 'luxury_wine_trx_addons_sc_type' ) ) {
	add_filter( 'trx_addons_sc_type', 'luxury_wine_trx_addons_sc_type', 10, 2);
	function luxury_wine_trx_addons_sc_type($list, $sc) {
		
		return $list;
	}
}

// Add new styles to the Google map
if ( !function_exists( 'luxury_wine_trx_addons_sc_googlemap_styles' ) ) {
	add_filter( 'trx_addons_filter_sc_googlemap_styles',	'luxury_wine_trx_addons_sc_googlemap_styles');
	function luxury_wine_trx_addons_sc_googlemap_styles($list) {
		$list[esc_html__('Dark', 'luxury-wine')] = 'dark';
		return $list;
	}
}
