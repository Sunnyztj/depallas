<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_blog_style = explode('_', luxury_wine_get_theme_option('blog_style'));
$luxury_wine_columns = empty($luxury_wine_blog_style[1]) ? 2 : max(2, $luxury_wine_blog_style[1]);
$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
$luxury_wine_animation = luxury_wine_get_theme_option('blog_animation');
$luxury_wine_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($luxury_wine_columns).' post_format_'.esc_attr($luxury_wine_post_format) ); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($luxury_wine_image[1]) && !empty($luxury_wine_image[2])) echo intval($luxury_wine_image[1]) .'x' . intval($luxury_wine_image[2]); ?>"
	data-src="<?php if (!empty($luxury_wine_image[0])) echo esc_url($luxury_wine_image[0]); ?>"
	>

	<?php
	$luxury_wine_image_hover = 'icon';
	if (in_array($luxury_wine_image_hover, array('icons', 'zoom'))) $luxury_wine_image_hover = 'dots';
	// Featured image
	luxury_wine_show_post_featured(array(
		'hover' => $luxury_wine_image_hover,
		'thumb_size' => luxury_wine_get_thumb_size( strpos(luxury_wine_get_theme_option('body_style'), 'full')!==false || $luxury_wine_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. luxury_wine_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'luxury-wine') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>