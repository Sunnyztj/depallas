<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('luxury_wine_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'luxury_wine_cf7_theme_setup9', 9 );
	function luxury_wine_cf7_theme_setup9() {
		
		if (luxury_wine_exists_cf7()) {
			add_action( 'wp_enqueue_scripts', 								'luxury_wine_cf7_frontend_scripts', 1100 );
			add_filter( 'luxury_wine_filter_merge_styles',						'luxury_wine_cf7_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'luxury_wine_filter_tgmpa_required_plugins',			'luxury_wine_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'luxury_wine_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('luxury_wine_filter_tgmpa_required_plugins',	'luxury_wine_cf7_tgmpa_required_plugins');
	function luxury_wine_cf7_tgmpa_required_plugins($list=array()) {
		if (in_array('contact-form-7', luxury_wine_storage_get('required_plugins'))) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> esc_html__('Contact Form 7', 'luxury-wine'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'luxury_wine_exists_cf7' ) ) {
	function luxury_wine_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'luxury_wine_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'luxury_wine_cf7_frontend_scripts', 1100 );
	function luxury_wine_cf7_frontend_scripts() {
		if (luxury_wine_is_on(luxury_wine_get_theme_option('debug_mode')) && luxury_wine_get_file_dir('plugins/contact-form-7/contact-form-7.css')!='')
			wp_enqueue_style( 'luxury-wine-contact-form-7',  luxury_wine_get_file_url('plugins/contact-form-7/contact-form-7.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'luxury_wine_cf7_merge_styles' ) ) {
	//Handler of the add_filter('luxury_wine_filter_merge_styles', 'luxury_wine_cf7_merge_styles');
	function luxury_wine_cf7_merge_styles($list) {
		$list[] = 'plugins/contact-form-7/contact-form-7.css';
		return $list;
	}
}
?>