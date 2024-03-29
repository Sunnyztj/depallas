<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

luxury_wine_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$luxury_wine_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$luxury_wine_sticky_out = is_array($luxury_wine_stickies) && count($luxury_wine_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($luxury_wine_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($luxury_wine_sticky_out && !is_sticky()) {
			$luxury_wine_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $luxury_wine_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($luxury_wine_sticky_out) {
		$luxury_wine_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	luxury_wine_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>