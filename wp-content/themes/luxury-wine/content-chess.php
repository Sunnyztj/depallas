<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_blog_style = explode('_', luxury_wine_get_theme_option('blog_style'));
$luxury_wine_columns = empty($luxury_wine_blog_style[1]) ? 1 : max(1, $luxury_wine_blog_style[1]);
$luxury_wine_expanded = !luxury_wine_sidebar_present() && luxury_wine_is_on(luxury_wine_get_theme_option('expand_content'));
$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
$luxury_wine_animation = luxury_wine_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($luxury_wine_columns).' post_format_'.esc_attr($luxury_wine_post_format) ); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($luxury_wine_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	luxury_wine_show_post_featured( array(
											'class' => $luxury_wine_columns == 0 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => luxury_wine_get_thumb_size(
																	strpos(luxury_wine_get_theme_option('body_style'), 'full')!==false
																		? ( $luxury_wine_columns > 1 ? 'huge' : 'original' )
																		: (	$luxury_wine_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header">
			<div class="post_icon icon-wine-glass"></div>
			<?php 
			// Post taxonomies
			the_tags( '<div class="post_tags">', ', ', '</div>' );
			
			do_action('luxury_wine_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$luxury_wine_show_learn_more = !in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'));
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?>
			</div>
			<?php
			// Post meta
			if (in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'))) {
				luxury_wine_show_layout($luxury_wine_post_meta);
			}
			// More button
			if ( $luxury_wine_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'luxury-wine'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>