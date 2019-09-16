<?php
/**
 * The Creative template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_blog_style = explode('_', luxury_wine_get_theme_option('blog_style'));
$luxury_wine_columns = 3;
$luxury_wine_expanded = !luxury_wine_sidebar_present() && luxury_wine_is_on(luxury_wine_get_theme_option('expand_content'));
$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
$luxury_wine_animation = luxury_wine_get_theme_option('blog_animation');

?><div class="column-1_3 post_creative"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($luxury_wine_post_format)
					. ' post_layout_creative'
					); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	>

	<?php

	// Featured image
	luxury_wine_show_post_featured( array( 'thumb_size' => luxury_wine_get_thumb_size('creative') ) );
	?>

	<div class="post_content entry-content">
		<?php
			if ( !in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote')) ) {
				?>
				<div class="post_header entry-header">
					<?php 
					do_action('luxury_wine_action_before_post_meta'); 
					$dt = apply_filters('luxury_wine_filter_get_post_date', luxury_wine_get_date());
					if (!empty($dt)) {
						$day = date_i18n("d", strtotime($dt));
						$month = date_i18n("F", strtotime($dt));
						?>
						<div class="post_meta">					
							<div class="post_meta_item post_date"><a href="<?php echo esc_url(get_permalink()); ?>"><span class="day"><?php echo esc_html($day); ?></span><?php echo ' '.esc_html($month); ?></a></div>
						</div>
						<?php
					}
					do_action('luxury_wine_action_before_post_title'); 

					// Post title
					the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
					?>
				</div><!-- .entry-header -->
				<?php
			}		
			
		// More button
		?><p><a class="more-link sc_button sc_button_simple sc_button_size_small" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'luxury-wine'); ?></a></p>
	</div><!-- .entry-content -->
</article></div>