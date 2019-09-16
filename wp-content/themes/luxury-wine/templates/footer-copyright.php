<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

// Copyright area
$luxury_wine_footer_scheme =  luxury_wine_is_inherit(luxury_wine_get_theme_option('footer_scheme')) ? luxury_wine_get_theme_option('color_scheme') : luxury_wine_get_theme_option('footer_scheme');
$luxury_wine_copyright_scheme = luxury_wine_is_inherit(luxury_wine_get_theme_option('copyright_scheme')) ? $luxury_wine_footer_scheme : luxury_wine_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($luxury_wine_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$luxury_wine_copyright = luxury_wine_prepare_macros(luxury_wine_get_theme_option('copyright'));
				if (!empty($luxury_wine_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $luxury_wine_copyright, $luxury_wine_matches)) {
						$luxury_wine_copyright = str_replace($luxury_wine_matches[1], date(str_replace(array('{', '}'), '', $luxury_wine_matches[1])), $luxury_wine_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($luxury_wine_copyright));
				}
			?></div>
			<?php 
			if (($luxury_wine_output = luxury_wine_get_socials_links()) != '') {
				?>
				<div class="footer_socials_wrap socials_wrap">
					<div class="footer_socials_inner">
						<?php luxury_wine_show_layout($luxury_wine_output); ?>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
