<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

luxury_wine_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', luxury_wine_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', luxury_wine_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', luxury_wine_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'luxury-wine-gallery-script', luxury_wine_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$luxury_wine_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$luxury_wine_sticky_out = is_array($luxury_wine_stickies) && count($luxury_wine_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$luxury_wine_cat = luxury_wine_get_theme_option('parent_cat');
	$luxury_wine_post_type = luxury_wine_get_theme_option('post_type');
	$luxury_wine_taxonomy = luxury_wine_get_post_type_taxonomy($luxury_wine_post_type);
	$luxury_wine_show_filters = luxury_wine_get_theme_option('show_filters');
	$luxury_wine_tabs = array();
	if (!luxury_wine_is_off($luxury_wine_show_filters)) {
		$luxury_wine_args = array(
			'type'			=> $luxury_wine_post_type,
			'child_of'		=> $luxury_wine_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $luxury_wine_taxonomy,
			'pad_counts'	=> false
		);
		$luxury_wine_portfolio_list = get_terms($luxury_wine_args);
		if (is_array($luxury_wine_portfolio_list) && count($luxury_wine_portfolio_list) > 0) {
			$luxury_wine_tabs[$luxury_wine_cat] = esc_html__('All', 'luxury-wine');
			foreach ($luxury_wine_portfolio_list as $luxury_wine_term) {
				if (isset($luxury_wine_term->term_id)) $luxury_wine_tabs[$luxury_wine_term->term_id] = $luxury_wine_term->name;
			}
		}
	}
	if (count($luxury_wine_tabs) > 0) {
		$luxury_wine_portfolio_filters_ajax = true;
		$luxury_wine_portfolio_filters_active = $luxury_wine_cat;
		$luxury_wine_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters luxury_wine_tabs luxury_wine_tabs_ajax">
			<ul class="portfolio_titles luxury_wine_tabs_titles">
				<?php
				foreach ($luxury_wine_tabs as $luxury_wine_id=>$luxury_wine_title) {
					?><li><a href="<?php echo esc_url(luxury_wine_get_hash_link(sprintf('#%s_%s_content', $luxury_wine_portfolio_filters_id, $luxury_wine_id))); ?>" data-tab="<?php echo esc_attr($luxury_wine_id); ?>"><?php echo esc_html($luxury_wine_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$luxury_wine_ppp = luxury_wine_get_theme_option('posts_per_page');
			if (luxury_wine_is_inherit($luxury_wine_ppp)) $luxury_wine_ppp = '';
			foreach ($luxury_wine_tabs as $luxury_wine_id=>$luxury_wine_title) {
				$luxury_wine_portfolio_need_content = $luxury_wine_id==$luxury_wine_portfolio_filters_active || !$luxury_wine_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $luxury_wine_portfolio_filters_id, $luxury_wine_id)); ?>"
					class="portfolio_content luxury_wine_tabs_content"
					data-blog-template="<?php echo esc_attr(luxury_wine_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(luxury_wine_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($luxury_wine_ppp); ?>"
					data-post-type="<?php echo esc_attr($luxury_wine_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($luxury_wine_taxonomy); ?>"
					data-cat="<?php echo esc_attr($luxury_wine_id); ?>"
					data-parent-cat="<?php echo esc_attr($luxury_wine_cat); ?>"
					data-need-content="<?php echo (false===$luxury_wine_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($luxury_wine_portfolio_need_content) 
						luxury_wine_show_portfolio_posts(array(
							'cat' => $luxury_wine_id,
							'parent_cat' => $luxury_wine_cat,
							'taxonomy' => $luxury_wine_taxonomy,
							'post_type' => $luxury_wine_post_type,
							'page' => 1,
							'sticky' => $luxury_wine_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		luxury_wine_show_portfolio_posts(array(
			'cat' => $luxury_wine_cat,
			'parent_cat' => $luxury_wine_cat,
			'taxonomy' => $luxury_wine_taxonomy,
			'post_type' => $luxury_wine_post_type,
			'page' => 1,
			'sticky' => $luxury_wine_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>