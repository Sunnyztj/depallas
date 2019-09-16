<?php
/**
 * The template for homepage posts with "Creative" style
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

luxury_wine_storage_set('blog_archive', true);

// Load scripts for 'Masonry' layout
if (substr(luxury_wine_get_theme_option('blog_style'), 0, 7) == 'masonry') {
	wp_enqueue_script( 'classie', luxury_wine_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
	wp_enqueue_script( 'imagesloaded', luxury_wine_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
	wp_enqueue_script( 'masonry', luxury_wine_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
	wp_enqueue_script( 'luxury-wine-gallery-script', luxury_wine_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );
}

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$luxury_wine_classes = 'posts_container '
						. (substr(luxury_wine_get_theme_option('blog_style'), 0, 8) == 'creative' ? 'columns_wrap' : 'creative_wrap');
	$luxury_wine_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$luxury_wine_sticky_out = is_array($luxury_wine_stickies) && count($luxury_wine_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($luxury_wine_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$luxury_wine_sticky_out) {
		if (luxury_wine_get_theme_option('first_post_large') && !is_paged() && !in_array(luxury_wine_get_theme_option('body_style'), array('fullwide', 'fullscreen'))) {
			the_post();
			get_template_part( 'content', 'excerpt' );
		}
		
		?><div class="<?php echo esc_attr($luxury_wine_classes); ?>"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($luxury_wine_sticky_out && !is_sticky()) {
			$luxury_wine_sticky_out = false;
			?></div><div class="<?php echo esc_attr($luxury_wine_classes); ?>"><?php
		}
		get_template_part( 'content', $luxury_wine_sticky_out && is_sticky() ? 'sticky' : 'creative' );
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