<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

if ( luxury_wine_is_on(luxury_wine_get_theme_option('socials_in_footer')) && ($luxury_wine_output = luxury_wine_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php luxury_wine_show_layout($luxury_wine_output); ?>
		</div>
	</div>
	<?php
}
?>