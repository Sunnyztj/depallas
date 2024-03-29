<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Previous/next post navigation.
	?><div class="nav-links-single"><?php
		the_post_navigation( array(
			'next_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'luxury-wine' ) . '</span> '
				. '<h6 class="post-title">%title</h6>'
				. '<span class="post_date">%date</span>',
			'prev_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'luxury-wine' ) . '</span> '
				. '<h6 class="post-title">%title</h6>'
				. '<span class="post_date">%date</span>'
		) );
	?></div><?php

	// Related posts.
	luxury_wine_show_related_posts(array('orderby' => 'rand',
									'posts_per_page' => max(2, min(4, luxury_wine_get_theme_option('related_posts')))
									),
								luxury_wine_get_theme_option('related_style')
								);

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>