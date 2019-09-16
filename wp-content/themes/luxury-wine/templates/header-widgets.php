<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

// Header sidebar
$luxury_wine_header_name = luxury_wine_get_theme_option('header_widgets');
$luxury_wine_header_present = !luxury_wine_is_off($luxury_wine_header_name) && is_active_sidebar($luxury_wine_header_name);
if ($luxury_wine_header_present) { 
	luxury_wine_storage_set('current_sidebar', 'header');
	$luxury_wine_header_wide = luxury_wine_get_theme_option('header_wide');
	ob_start();
	if ( !dynamic_sidebar($luxury_wine_header_name) ) {
		// Put here html if user no set widgets in sidebar
	}
	$luxury_wine_widgets_output = ob_get_contents();
	ob_end_clean();
	if (trim(strip_tags($luxury_wine_widgets_output)) != '') {
		$luxury_wine_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $luxury_wine_widgets_output);
		$luxury_wine_need_columns = strpos($luxury_wine_widgets_output, 'columns_wrap')===false;
		if ($luxury_wine_need_columns) {
			$luxury_wine_columns = max(0, (int) luxury_wine_get_theme_option('header_columns'));
			if ($luxury_wine_columns == 0) $luxury_wine_columns = min(6, max(1, substr_count($luxury_wine_widgets_output, '<aside ')));
			if ($luxury_wine_columns > 1)
				$luxury_wine_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($luxury_wine_columns).' widget ', $luxury_wine_widgets_output);
			else
				$luxury_wine_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($luxury_wine_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$luxury_wine_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($luxury_wine_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'luxury_wine_action_before_sidebar' );
				luxury_wine_show_layout($luxury_wine_widgets_output);
				do_action( 'luxury_wine_action_after_sidebar' );
				if ($luxury_wine_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$luxury_wine_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>