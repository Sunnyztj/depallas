<?php
/**
 * Shortcode: Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_sc_blogger_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_sc_blogger_load_scripts_front');
	function trx_addons_sc_blogger_load_scripts_front() {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_style( 'trx_addons-sc_blogger', trx_addons_get_file_url('shortcodes/blogger/blogger.css'), array(), null );
		}
	}
}

	
// Merge shortcode's specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_blogger_merge_styles' ) ) {
	add_action("trx_addons_filter_merge_styles", 'trx_addons_sc_blogger_merge_styles');
	function trx_addons_sc_blogger_merge_styles($list) {
		$list[] = 'shortcodes/blogger/blogger.css';
		return $list;
	}
}

// Merge shortcode's specific scripts into single file
if ( !function_exists( 'trx_addons_sc_blogger_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_blogger_merge_scripts');
	function trx_addons_sc_blogger_merge_scripts($list) {
		$list[] = 'shortcodes/blogger/blogger.js';
		return $list;
	}
}

// trx_sc_blogger
//-------------------------------------------------------------
/*
[trx_sc_blogger id="unique_id" type="default" cat="category_slug or id" count="3" columns="3" slider="0|1"]
*/
if ( !function_exists( 'trx_addons_sc_blogger' ) ) {
	function trx_addons_sc_blogger($atts, $content=null) {	
		$atts = trx_addons_sc_prepare_atts('trx_sc_blogger', $atts, array(
			// Individual params
			"type" => 'default',
			"hide_excerpt" => 0,
			"columns" => '',
			"cat" => '',
			"count" => 3,
			"offset" => 0,
			"orderby" => '',
			"order" => '',
			"ids" => '',
			"slider" => 0,
			"slider_pagination" => 0,
			"slides_space" => 0,
			"title" => '',
			"subtitle" => '',
			"description" => '',
			"link" => '',
			"link_image" => '',
			"link_text" => esc_html__('Learn more', 'trx_addons'),
			"title_align" => 'left',
			"title_style" => 'default',
			"title_tag" => '',
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			)
		);
		
		if (trx_addons_is_on(trx_addons_get_option('debug_mode')))
				wp_enqueue_script( 'trx_addons-sc_blogger', trx_addons_get_file_url('shortcodes/blogger/blogger.js'), array('jquery'), null, true );
			
		if (!empty($atts['ids'])) {
			$atts['ids'] = str_replace(array(';', ' '), array(',', ''), $atts['ids']);
			$atts['count'] = count(explode(',', $atts['ids']));
		}
		$atts['count'] = max(1, (int) $atts['count']);
		$atts['offset'] = max(0, (int) $atts['offset']);
		if (empty($atts['orderby'])) $atts['orderby'] = 'date';
		if (empty($atts['order'])) $atts['order'] = 'desc';
		$atts['slider'] = max(0, (int) $atts['slider']);
		$atts['slider_pagination'] = $atts['slider'] > 0 ? max(0, (int) $atts['slider_pagination']) : 0;

		ob_start();
		set_query_var('trx_addons_args_sc_blogger', $atts);
		if (($fdir = trx_addons_get_file_dir('shortcodes/blogger/tpl.'.trx_addons_esc($atts['type']).'.php')) != '') { include $fdir; }
		else if (($fdir = trx_addons_get_file_dir('shortcodes/blogger/tpl.default.php')) != '') { include $fdir; }
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_blogger', $atts, $content);
	}
	if (trx_addons_exists_visual_composer()) add_shortcode("trx_sc_blogger", "trx_addons_sc_blogger");
}


// Add [trx_sc_blogger] in the VC shortcodes list
if (!function_exists('trx_addons_sc_blogger_add_in_vc')) {
	function trx_addons_sc_blogger_add_in_vc() {

		vc_map( apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_blogger",
				"name" => esc_html__("Blogger", 'trx_addons'),
				"description" => wp_kses_data( __("Display posts from specified category in many styles", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_blogger',
				"class" => "trx_sc_blogger",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							"admin_label" => true,
							"class" => "",
							"std" => "default",
							"value" => apply_filters('trx_addons_sc_type', array(
								esc_html__('Default', 'trx_addons') => 'default',
								esc_html__('Classic', 'trx_addons') => 'classic',
								esc_html__('Creative', 'trx_addons') => 'creative'
							), 'trx_sc_blogger' ),
							"type" => "dropdown"
						),
						array(
							"param_name" => "hide_excerpt",
							"heading" => esc_html__("Excerpt", 'trx_addons'),
							"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
							'dependency' => array(
								'element' => 'type',
								'value' => array('classic', 'default')
							),
							"std" => "0",
							"value" => array(esc_html__("Hide excerpt", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "cat",
							"heading" => esc_html__("Category", 'trx_addons'),
							"description" => wp_kses_data( __("Select category to show posts", 'trx_addons') ),
							"value" => array_merge(array(esc_html__('- Select category -', 'trx_addons') => 0), array_flip(trx_addons_get_list_categories())),
							"type" => "dropdown"
						),
						array(
							"param_name" => "ids",
							"heading" => esc_html__("IDs to show", 'trx_addons'),
							"description" => wp_kses_data( __("Comma separated IDs list to show. If not empty - parameters 'cat', 'offset' and 'count' are ignored!", 'trx_addons') ),
							"admin_label" => true,
							"type" => "textfield"
						),
						array(
							"param_name" => "offset",
							"heading" => esc_html__("Offset", 'trx_addons'),
							"description" => wp_kses_data( __("Specify number of items to skip before showed items", 'trx_addons') ),
							'dependency' => array(
								'element' => 'ids',
								'is_empty' => true
							),
							"admin_label" => true,
							"type" => "textfield"
						),
						array(
							"param_name" => "count",
							"heading" => esc_html__("Count", 'trx_addons'),
							"description" => wp_kses_data( __("Specify number of items to display", 'trx_addons') ),
							'dependency' => array(
								'element' => 'ids',
								'is_empty' => true
							),
							"admin_label" => true,
							"type" => "textfield"
						),
						array(
							"param_name" => "columns",
							"heading" => esc_html__("Columns", 'trx_addons'),
							"description" => wp_kses_data( __("Specify number of columns. If empty - auto detect by items number", 'trx_addons') ),
							'dependency' => array(
								'element' => 'type',
								'value' => array('classic', 'default', 'plain')
							),
							"admin_label" => true,
							"type" => "textfield"
						),
						array(
							"param_name" => "orderby",
							"heading" => esc_html__("Order by", 'trx_addons'),
							"description" => wp_kses_data( __("Select how to sort the posts", 'trx_addons') ),
							"value" => array(
								esc_html__('None', 'trx_addons') => 'none',
								esc_html__('Post ID', 'trx_addons') => 'ID',
								esc_html__('Date', 'trx_addons') => 'post_date',
								esc_html__('Title', 'trx_addons') => 'title',
								esc_html__('Random', 'trx_addons') => 'rand'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "order",
							"heading" => esc_html__("Order", 'trx_addons'),
							"description" => wp_kses_data( __("Select sort order", 'trx_addons') ),
							"value" => array(
								esc_html__('Descending', 'trx_addons') => 'desc',
								esc_html__('Ascending', 'trx_addons') => 'asc'
							),
							"std" => "asc",
							"type" => "dropdown"
						),
						array(
							"param_name" => "slider",
							"heading" => esc_html__("Slider", 'trx_addons'),
							"description" => wp_kses_data( __("Show items as slider", 'trx_addons') ),
							"admin_label" => true,
							'dependency' => array(
								'element' => 'type',
								'value' => array('classic', 'default', 'plain')
							),
							"std" => "0",
							"value" => array(esc_html__("Slider", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "slider_pagination",
							"heading" => esc_html__("Slider pagination", 'trx_addons'),
							"description" => wp_kses_data( __("Show pagination bullets below slider", 'trx_addons') ),
							'dependency' => array(
								'element' => 'slider',
								'value' => '1'
							),
							"std" => "0",
							"value" => array(esc_html__("Show bullets", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "slides_space",
							"heading" => esc_html__("Space", 'trx_addons'),
							"description" => wp_kses_data( __("Space between slides", 'trx_addons') ),
							'dependency' => array(
								'element' => 'slider',
								'value' => '1'
							),
							"value" => "0",
							"type" => "textfield"
						)
					),
					trx_addons_vc_add_title_param(),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_blogger' ) );
			
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Trx_Sc_Blogger extends WPBakeryShortCode {}
		}

	}
	if (trx_addons_exists_visual_composer()) add_action('after_setup_theme', 'trx_addons_sc_blogger_add_in_vc', 20);
}
?>