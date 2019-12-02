<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

if ( get_query_var('luxury_wine_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$luxury_wine_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($luxury_wine_src[0])) {
		luxury_wine_sc_layouts_showed('featured', true);
		?><div class="sc_layouts_featured with_image <?php echo esc_attr(luxury_wine_add_inline_style('background-image:url('.esc_url($luxury_wine_src[0]).');')); ?>"></div><?php
	}
}
?>