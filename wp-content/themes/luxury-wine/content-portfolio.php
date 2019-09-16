<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($luxury_wine_columns).' post_format_'.esc_attr($luxury_wine_post_format) ); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	>

	<?php
	$luxury_wine_image_hover = luxury_wine_get_theme_option('image_hover');
	// Featured image
	luxury_wine_show_post_featured(array(
		'thumb_size' => luxury_wine_get_thumb_size(strpos(luxury_wine_get_theme_option('body_style'), 'full')!==false || $luxury_wine_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $luxury_wine_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $luxury_wine_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>