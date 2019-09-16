<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0.14
 */
$luxury_wine_header_video = luxury_wine_get_header_video();
if (!empty($luxury_wine_header_video) && !luxury_wine_is_from_uploads($luxury_wine_header_video)) {
	global $wp_embed;
	if (is_object($wp_embed))
		$luxury_wine_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($luxury_wine_header_video) . '[/embed]' ));
	$luxury_wine_embed_video = luxury_wine_make_video_autoplay($luxury_wine_embed_video);
	?><div id="background_video"><?php luxury_wine_show_layout($luxury_wine_embed_video); ?></div><?php
}
?>