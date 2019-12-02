<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.10
 */

// Logo
if (luxury_wine_is_on(luxury_wine_get_theme_option('logo_in_footer'))) {
	$luxury_wine_logo_image = '';
	if (luxury_wine_get_retina_multiplier(2) > 1)
		$luxury_wine_logo_image = luxury_wine_get_theme_option( 'logo_footer_retina' );
	if (empty($luxury_wine_logo_image)) 
		$luxury_wine_logo_image = luxury_wine_get_theme_option( 'logo_footer' );
	$luxury_wine_logo_text   = get_bloginfo( 'name' );
	if (!empty($luxury_wine_logo_image) || !empty($luxury_wine_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($luxury_wine_logo_image)) {
					$luxury_wine_attr = luxury_wine_getimagesize($luxury_wine_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($luxury_wine_logo_image).'" class="logo_footer_image" alt="'.esc_html(basename($luxury_wine_logo_image)).'"'.(!empty($luxury_wine_attr[3]) ? sprintf(' %s', $luxury_wine_attr[3]) : '').'></a>' ;
				} else if (!empty($luxury_wine_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($luxury_wine_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>