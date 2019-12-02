<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

$luxury_wine_footer_scheme =  luxury_wine_is_inherit(luxury_wine_get_theme_option('footer_scheme')) ? luxury_wine_get_theme_option('color_scheme') : luxury_wine_get_theme_option('footer_scheme');
$luxury_wine_footer_id = str_replace('footer-custom-', '', luxury_wine_get_theme_option("footer_style"));
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($luxury_wine_footer_id); ?> scheme_<?php echo esc_attr($luxury_wine_footer_scheme); ?>">
	<?php
    // Custom footer's layout
    do_action('luxury_wine_action_show_layout', $luxury_wine_footer_id);
	?>
</footer><!-- /.footer_wrap -->
