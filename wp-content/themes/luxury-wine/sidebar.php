<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_sidebar_position = luxury_wine_get_theme_option('sidebar_position');
if (luxury_wine_sidebar_present()) {
	ob_start();
	$luxury_wine_sidebar_name = luxury_wine_get_theme_option('sidebar_widgets');
	luxury_wine_storage_set('current_sidebar', 'sidebar');
	if ( !dynamic_sidebar($luxury_wine_sidebar_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$luxury_wine_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($luxury_wine_out)) != '') {
		?>
		<div class="sidebar <?php echo esc_attr($luxury_wine_sidebar_position); ?> widget_area<?php if (!luxury_wine_is_inherit(luxury_wine_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(luxury_wine_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'luxury_wine_action_before_sidebar' );
				luxury_wine_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $luxury_wine_out));
				do_action( 'luxury_wine_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>