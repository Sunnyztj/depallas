<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

// Footer menu
$luxury_wine_menu_footer = luxury_wine_get_nav_menu('menu_footer');
if (!empty($luxury_wine_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php luxury_wine_show_layout($luxury_wine_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>