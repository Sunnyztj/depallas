<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
$luxury_wine_animation = luxury_wine_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($luxury_wine_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($luxury_wine_post_format) ); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	luxury_wine_show_post_featured(array(
		'thumb_size' => luxury_wine_get_thumb_size($luxury_wine_columns==1 ? 'big' : ($luxury_wine_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			luxury_wine_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>