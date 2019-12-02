<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */
?>

<div class="author_info scheme_default author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$luxury_wine_mult = luxury_wine_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$luxury_wine_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<div class="author_subtitle"><?php echo esc_html__('About Me', 'luxury-wine'); ?></div>
		<h4 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('Hi to everyone. My name is  %s!', 'luxury-wine'), '<span class="fn">'.get_the_author().'</span>')); ?></h4>

		<div class="author_bio" itemprop="description">
			<?php echo wpautop(get_the_author_meta( 'description' )); ?>
			<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'luxury-wine' ), '<span class="author_name">' . esc_html(get_the_author()) . '</span>' ); ?>
			</a>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
