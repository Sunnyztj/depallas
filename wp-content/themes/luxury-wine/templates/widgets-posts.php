<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_post_id    = get_the_ID();
$luxury_wine_post_date  = luxury_wine_get_date();
$luxury_wine_post_title = get_the_title();
$luxury_wine_post_link  = get_permalink();
$luxury_wine_post_author_id   = get_the_author_meta('ID');
$luxury_wine_post_author_name = get_the_author_meta('display_name');
$luxury_wine_post_author_url  = get_author_posts_url($luxury_wine_post_author_id, '');

$luxury_wine_args = get_query_var('luxury_wine_args_widgets_posts');
$luxury_wine_show_date = isset($luxury_wine_args['show_date']) ? (int) $luxury_wine_args['show_date'] : 1;
$luxury_wine_show_image = isset($luxury_wine_args['show_image']) ? (int) $luxury_wine_args['show_image'] : 1;
$luxury_wine_show_author = isset($luxury_wine_args['show_author']) ? (int) $luxury_wine_args['show_author'] : 1;
$luxury_wine_show_counters = isset($luxury_wine_args['show_counters']) ? (int) $luxury_wine_args['show_counters'] : 1;
$luxury_wine_show_categories = isset($luxury_wine_args['show_categories']) ? (int) $luxury_wine_args['show_categories'] : 1;

$luxury_wine_output = luxury_wine_storage_get('luxury_wine_output_widgets_posts');

$luxury_wine_post_counters_output = '';
if ( $luxury_wine_show_counters ) {
	$luxury_wine_post_counters_output = '<span class="post_info_item post_info_counters">'
								. luxury_wine_get_post_counters('comments')
							. '</span>';
}


$luxury_wine_output .= '<article class="post_item with_thumb">';

if ($luxury_wine_show_image) {
	$luxury_wine_post_thumb = get_the_post_thumbnail($luxury_wine_post_id, luxury_wine_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($luxury_wine_post_thumb) $luxury_wine_output .= '<div class="post_thumb">' . ($luxury_wine_post_link ? '<a href="' . esc_url($luxury_wine_post_link) . '">' : '') . ($luxury_wine_post_thumb) . ($luxury_wine_post_link ? '</a>' : '') . '</div>';
}

$luxury_wine_output .= '<div class="post_content">'
			. ($luxury_wine_show_categories 
					? '<div class="post_categories">'
						. luxury_wine_get_post_categories()
						. $luxury_wine_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($luxury_wine_post_link ? '<a href="' . esc_url($luxury_wine_post_link) . '">' : '') . ($luxury_wine_post_title) . ($luxury_wine_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('luxury_wine_filter_get_post_info', 
								'<div class="post_info">'
									. ($luxury_wine_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($luxury_wine_post_link ? '<a href="' . esc_url($luxury_wine_post_link) . '" class="post_info_date">' : '') 
											. esc_html($luxury_wine_post_date) 
											. ($luxury_wine_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($luxury_wine_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'luxury-wine') . ' ' 
											. ($luxury_wine_post_link ? '<a href="' . esc_url($luxury_wine_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($luxury_wine_post_author_name) 
											. ($luxury_wine_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$luxury_wine_show_categories && $luxury_wine_post_counters_output
										? $luxury_wine_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
luxury_wine_storage_set('luxury_wine_output_widgets_posts', $luxury_wine_output);
?>