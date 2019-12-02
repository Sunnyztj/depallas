<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('luxury_wine_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'luxury_wine_mailchimp_theme_setup9', 9 );
	function luxury_wine_mailchimp_theme_setup9() {
		if (luxury_wine_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'luxury_wine_mailchimp_frontend_scripts', 1100 );
			add_filter( 'luxury_wine_filter_merge_styles',					'luxury_wine_mailchimp_merge_styles');
			add_filter( 'luxury_wine_filter_get_css',						'luxury_wine_mailchimp_get_css', 10, 4);
		}
		if (is_admin()) {
			add_filter( 'luxury_wine_filter_tgmpa_required_plugins',		'luxury_wine_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'luxury_wine_exists_mailchimp' ) ) {
	function luxury_wine_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'luxury_wine_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('luxury_wine_filter_tgmpa_required_plugins',	'luxury_wine_mailchimp_tgmpa_required_plugins');
	function luxury_wine_mailchimp_tgmpa_required_plugins($list=array()) {
		if (in_array('mailchimp-for-wp', luxury_wine_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('MailChimp for WP', 'luxury-wine'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'luxury_wine_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'luxury_wine_mailchimp_frontend_scripts', 1100 );
	function luxury_wine_mailchimp_frontend_scripts() {
		if (luxury_wine_exists_mailchimp()) {
			if (luxury_wine_is_on(luxury_wine_get_theme_option('debug_mode')) && luxury_wine_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'luxury-wine-mailchimp-for-wp',  luxury_wine_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'luxury_wine_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'luxury_wine_filter_merge_styles', 'luxury_wine_mailchimp_merge_styles');
	function luxury_wine_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}

// Add css styles into global CSS stylesheet
if (!function_exists('luxury_wine_mailchimp_get_css')) {
	//Handler of the add_filter('luxury_wine_filter_get_css', 'luxury_wine_mailchimp_get_css', 10, 4);
	function luxury_wine_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = luxury_wine_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	   -moz-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['alter_dark']};
	border-color: {$colors['alter_dark']};
	color: {$colors['bg_color']};
}
.mc4wp-form input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.mc4wp-form input[type="submit"]:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_link_blend']};
}

.widget_mc4wp_form_widget{
    background-color: {$colors['alter_dark']};
}

CSS;
		}

		return $css;
	}
}
?>