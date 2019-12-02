<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.06
 */

$luxury_wine_header_css = $luxury_wine_header_image = '';
$luxury_wine_header_video = luxury_wine_get_header_video();
if (true || empty($luxury_wine_header_video)) {
	$luxury_wine_header_image = get_header_image();
	if (luxury_wine_is_on(luxury_wine_get_theme_option('header_image_override')) && apply_filters('luxury_wine_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($luxury_wine_cat_img = luxury_wine_get_category_image()) != '')
				$luxury_wine_header_image = $luxury_wine_cat_img;
		} else if (is_singular() || luxury_wine_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$luxury_wine_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($luxury_wine_header_image)) $luxury_wine_header_image = $luxury_wine_header_image[0];
			} else
				$luxury_wine_header_image = '';
		}
	}
}

$luxury_wine_header_id = str_replace('header-custom-', '', luxury_wine_get_theme_option("header_style"));

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($luxury_wine_header_id);
						echo !empty($luxury_wine_header_image) || !empty($luxury_wine_header_video) ? ' with_bg_image' : ' without_bg_image';
						if ($luxury_wine_header_video!='') echo ' with_bg_video';
						if ($luxury_wine_header_image!='') echo ' '.esc_attr(luxury_wine_add_inline_style('background-image: url('.esc_url($luxury_wine_header_image).');'));
						if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
						if (luxury_wine_is_on(luxury_wine_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(luxury_wine_is_inherit(luxury_wine_get_theme_option('header_scheme')) 
														? luxury_wine_get_theme_option('color_scheme') 
														: luxury_wine_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($luxury_wine_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('luxury_wine_action_show_layout', $luxury_wine_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );


		
?></header>