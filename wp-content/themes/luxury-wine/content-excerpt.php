<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_post_format = get_post_format();
$luxury_wine_post_format = empty($luxury_wine_post_format) ? 'standard' : str_replace('post-format-', '', $luxury_wine_post_format);
$luxury_wine_full_content = luxury_wine_get_theme_option('blog_content') != 'excerpt' || in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'));
$luxury_wine_animation = luxury_wine_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($luxury_wine_post_format) ); ?>
	<?php echo (!luxury_wine_is_off($luxury_wine_animation) ? ' data-animation="'.esc_attr(luxury_wine_get_animation_classes($luxury_wine_animation)).'"' : ''); ?>
	><?php

	// Featured image
	luxury_wine_show_post_featured(array( 'thumb_size' => luxury_wine_get_thumb_size( strpos(luxury_wine_get_theme_option('body_style'), 'full')!==false ? 'full' : 'huge' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('luxury_wine_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );

			do_action('luxury_wine_action_before_post_meta'); 

			// Post meta
			luxury_wine_show_post_meta(array(
				'categories' => false,
				'author' => true,
				'date' => true,
				'edit' => false,
				'seo' => false,
				'share' => false,
				'counters' => 'comments'	//comments,likes,views - comma separated in any combination
				)
			);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if ($luxury_wine_full_content) {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'luxury-wine' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'luxury-wine' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$luxury_wine_show_learn_more = !in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($luxury_wine_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $luxury_wine_show_learn_more ) {
				?><p><a class="more-link sc_button sc_button_simple sc_button_size_small" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Learn More', 'luxury-wine'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>