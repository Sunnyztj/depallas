<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_link = get_permalink();
$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($luxury_wine_post_format) ); ?>><?php
	luxury_wine_show_post_featured(array(
		'thumb_size' => luxury_wine_get_thumb_size( 'related' ),
		'show_no_image' => true,
		'slides_ratio' => '99:70',
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			$dt = apply_filters('luxury_wine_filter_get_post_date', luxury_wine_get_date());
			if (!empty($dt)) {
				$day = date("d", strtotime($dt));
				$month = date("F", strtotime($dt));
				?>
				<div class="post_meta">					
					<div class="post_meta_item post_date"><a href="<?php echo esc_url(get_permalink()); ?>"><span class="day"><?php echo esc_html($day); ?></span><?php echo ' '.esc_html($month); ?></a></div>
				</div>
				<?php
			}
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($luxury_wine_link); ?>"><?php echo the_title(); ?></a></h6>
	</div>
</div>