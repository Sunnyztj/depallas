<?php
/**
 * The style "default" of the Blogger
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
		'thumb_size' => trx_addons_get_thumb_size('medium')
	));
	if (($fdir = trx_addons_get_file_dir('templates/tpl.featured.php')) != '') { include $fdir; }
	
	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Post title
		?><div class="sc_blogger_item_header entry-header"><?php 
			// Post title
			the_title( sprintf( '<h1 class="sc_blogger_item_title entry-title"><a href="%s" rel="bookmark">', esc_url( $post_link ) ), '</a></h1>' );
			// Post meta
			trx_addons_sc_show_post_meta('sc_blogger', array(
				'date' => true,
				'author' => true,
				'categories' => true,
				)
			);
		?></div><!-- .entry-header --><?php
		$show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
		// Post content
		if (!isset($args['hide_excerpt']) || $args['hide_excerpt']==0) {
			?><div class="sc_blogger_item_excerpt">
				<div class="sc_blogger_item_excerpt_text">
					<?php
					if (has_excerpt()) {
						the_excerpt();
					} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
						the_content( '' );
					} else if (!$show_more) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
				<?php
				// Post meta
				if (in_array($post_format, array('link', 'aside', 'status', 'quote'))) {
					trx_addons_sc_show_post_meta('sc_blogger', array(
						'date' => true
						)
					);
				}
			?></div><!-- .sc_blogger_item_excerpt --><?php
		}
		// More button
		if ( $show_more ) {
			?><div class="sc_blogger_item_button sc_item_button"><a href="<?php echo esc_url($post_link); ?>" class="sc_button"><?php esc_html_e('Read More', 'trx_addons'); ?></a></div><?php
		}
	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>