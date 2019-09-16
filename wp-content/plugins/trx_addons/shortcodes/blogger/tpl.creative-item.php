<?php
/**
 * The style "creative" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

?><div id="post-<?php the_ID(); ?>"	<?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php

	// Featured image
	set_query_var('trx_addons_args_featured', array(
		'class' => 'sc_blogger_item_featured',
		'hover' => 'zoomin',
		'thumb_size' => trx_addons_get_thumb_size($args['columns'] > 2 ? 'blogger-creative' : 'big')
	));
	if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Post title
		if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
			?><div class="sc_blogger_item_header entry-header"><?php 
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
				// Post title
				the_title( sprintf( '<h5 class="sc_blogger_item_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
			?></div><!-- .entry-header --><?php
		}		
		$show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote')); 

		// More button
		if ( $show_more ) {
			?><div class="sc_blogger_item_button sc_item_button"><a href="<?php echo esc_url($post_link); ?>" class="sc_button sc_button_simple sc_button_size_small"><?php esc_html_e('Read More', 'trx_addons'); ?></a></div><?php
		}
		
	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>