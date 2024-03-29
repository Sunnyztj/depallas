<?php
/**
 * The template to display block with post meta
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

extract(get_query_var('trx_addons_args_sc_show_post_meta'));

?><div class="<?php echo esc_attr($sc); ?>_post_meta post_meta"><?php
	// Post categories
	if ( !empty($args['categories']) ) {
		?><span class="post_meta_item post_categories"><?php the_category( ', ' ); ?></span><?php
	}
	// Post author
	if ( !empty($args['author'])) {	
		?>
		<a class="post_meta_item post_author" rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
			<?php echo esc_html__('By ', 'trx_addons') . esc_html(get_the_author()); ?>
		</a>
		<?php
	}
	// Post tags
	if ( !empty($args['tags']) ) {
		the_tags( '<span class="post_meta_item post_tags">', ', ', '</span>' );
	}
	// Post date
	if ( !empty($args['date']) && in_array( get_post_type(), array( 'post', 'page', 'attachment' ) ) ) {
		?><span class="post_meta_item post_date<?php if (!empty($args['seo'])) echo ' date updated'; ?>"<?php if (!empty($args['seo'])) echo ' itemprop="datePublished"'; ?>><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo apply_filters('trx_addons_filter_get_post_date', get_the_date()); ?></a></span><?php
	}
	// Post counters
	if ( !empty($args['counters']) ) {
		echo str_replace('post_counters_item', 'post_meta_item post_counters_item', trx_addons_get_post_counters($args['counters']));
	}
	// Socials share
	if ( !empty($args['share']) ) {
		$output = trx_addons_get_share_links(array(
				'type' => 'drop',
				'caption' => esc_html__('Share', 'trx_addons'),
				'echo' => false
			));
		if ($output) {
			?><span class="post_meta_item post_share"><?php echo trim($output); ?></span><?php
		}
	}
	// Edit page link
	if ( !empty($args['edit']) ) {
		edit_post_link( esc_html__( 'Edit', 'trx_addons' ), '<span class="post_meta_item post_edit">', '</span>' );
	}
?></div><!-- .post_meta --><?php
