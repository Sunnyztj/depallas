<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

// Footer sidebar
$luxury_wine_footer_name = luxury_wine_get_theme_option('footer_widgets');
$luxury_wine_footer_present = !luxury_wine_is_off($luxury_wine_footer_name) && is_active_sidebar($luxury_wine_footer_name);
if ($luxury_wine_footer_present) { 
	luxury_wine_storage_set('current_sidebar', 'footer');
	$luxury_wine_footer_wide = luxury_wine_get_theme_option('footer_wide');
	ob_start();
	if ( !dynamic_sidebar($luxury_wine_footer_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$luxury_wine_out = trim(ob_get_contents());
	ob_end_clean();
	if (trim(strip_tags($luxury_wine_out)) != '') {
		$luxury_wine_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $luxury_wine_out);
		$luxury_wine_need_columns = true;
		if ($luxury_wine_need_columns) {
			$luxury_wine_columns = max(0, (int) luxury_wine_get_theme_option('footer_columns'));
			if ($luxury_wine_columns == 0) $luxury_wine_columns = min(6, max(1, substr_count($luxury_wine_out, '<aside ')));
			if ($luxury_wine_columns > 1)
				$luxury_wine_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($luxury_wine_columns).' widget ', $luxury_wine_out);
			else
				$luxury_wine_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($luxury_wine_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$luxury_wine_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($luxury_wine_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'luxury_wine_action_before_sidebar' );
				luxury_wine_show_layout($luxury_wine_out);
				do_action( 'luxury_wine_action_after_sidebar' );
				if ($luxury_wine_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$luxury_wine_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>