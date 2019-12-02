<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$luxury_wine_content = '';
$luxury_wine_blog_archive_mask = '%%CONTENT%%';
$luxury_wine_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $luxury_wine_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($luxury_wine_content = apply_filters('the_content', get_the_content())) != '') {
		if (($luxury_wine_pos = strpos($luxury_wine_content, $luxury_wine_blog_archive_mask)) !== false) {
			$luxury_wine_content = preg_replace('/(\<p\>\s*)?'.$luxury_wine_blog_archive_mask.'(\s*\<\/p\>)/i', $luxury_wine_blog_archive_subst, $luxury_wine_content);
		} else
			$luxury_wine_content .= $luxury_wine_blog_archive_subst;
		$luxury_wine_content = explode($luxury_wine_blog_archive_mask, $luxury_wine_content);
	}
}

// Prepare args for a new query
$luxury_wine_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$luxury_wine_args = luxury_wine_query_add_posts_and_cats($luxury_wine_args, '', luxury_wine_get_theme_option('post_type'), luxury_wine_get_theme_option('parent_cat'));
$luxury_wine_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($luxury_wine_page_number > 1) {
	$luxury_wine_args['paged'] = $luxury_wine_page_number;
	$luxury_wine_args['ignore_sticky_posts'] = true;
}
$luxury_wine_ppp = luxury_wine_get_theme_option('posts_per_page');
if ((int) $luxury_wine_ppp != 0)
	$luxury_wine_args['posts_per_page'] = (int) $luxury_wine_ppp;
// Make a new query
query_posts( $luxury_wine_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($luxury_wine_content) && count($luxury_wine_content) == 2) {
	set_query_var('blog_archive_start', $luxury_wine_content[0]);
	set_query_var('blog_archive_end', $luxury_wine_content[1]);
}

get_template_part('index');
?>