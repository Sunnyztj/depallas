<?php
/**
 * The template to displaying popup with Theme Icons
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_icons = luxury_wine_get_list_icons();
if (is_array($luxury_wine_icons)) {
	?>
	<div class="luxury_wine_list_icons">
		<?php
		foreach($luxury_wine_icons as $icon) {
			?><span class="<?php echo esc_attr($icon); ?>" title="<?php echo esc_attr($icon); ?>"></span><?php
		}
		?>
	</div>
	<?php
}
?>