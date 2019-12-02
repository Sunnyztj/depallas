<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

						// Widgets area inside page content
						luxury_wine_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					luxury_wine_create_widgets_area('widgets_below_page');

					$luxury_wine_body_style = luxury_wine_get_theme_option('body_style');
					if ($luxury_wine_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$luxury_wine_footer_style = luxury_wine_get_theme_option("footer_style");
			if (strpos($luxury_wine_footer_style, 'footer-custom-')===0) $luxury_wine_footer_style = 'footer-custom';
			get_template_part( "templates/{$luxury_wine_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (luxury_wine_is_on(luxury_wine_get_theme_option('debug_mode')) && luxury_wine_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(luxury_wine_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>