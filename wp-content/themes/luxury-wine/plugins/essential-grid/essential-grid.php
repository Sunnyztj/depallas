<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('luxury_wine_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'luxury_wine_essential_grid_theme_setup9', 9 );
	function luxury_wine_essential_grid_theme_setup9() {
		if (luxury_wine_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'luxury_wine_essential_grid_frontend_scripts', 1100 );
			add_filter( 'luxury_wine_filter_merge_styles',					'luxury_wine_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'luxury_wine_filter_tgmpa_required_plugins',		'luxury_wine_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'luxury_wine_exists_essential_grid' ) ) {
	function luxury_wine_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'luxury_wine_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('luxury_wine_filter_tgmpa_required_plugins',	'luxury_wine_essential_grid_tgmpa_required_plugins');
	function luxury_wine_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', luxury_wine_storage_get('required_plugins'))) {
			$path = luxury_wine_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'luxury-wine'),
						'slug' 		=> 'essential-grid',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'luxury_wine_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'luxury_wine_essential_grid_frontend_scripts', 1100 );
	function luxury_wine_essential_grid_frontend_scripts() {
		if (luxury_wine_is_on(luxury_wine_get_theme_option('debug_mode')) && luxury_wine_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'luxury-wine-essential-grid',  luxury_wine_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'luxury_wine_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('luxury_wine_filter_merge_styles', 'luxury_wine_essential_grid_merge_styles');
	function luxury_wine_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>