<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage LUXURY-WINE
 * @since LUXURY-WINE 1.0
 */

$luxury_wine_args = get_query_var('luxury_wine_logo_args');

// Site logo
$luxury_wine_logo_image  = luxury_wine_get_logo_image(isset($luxury_wine_args['type']) ? $luxury_wine_args['type'] : '');
$luxury_wine_logo_text   = luxury_wine_is_on(luxury_wine_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$luxury_wine_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($luxury_wine_logo_image) || !empty($luxury_wine_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($luxury_wine_logo_image)) {
			$luxury_wine_attr = luxury_wine_getimagesize($luxury_wine_logo_image);
			echo '<img src="'.esc_url($luxury_wine_logo_image).'" alt="'.esc_html(basename($luxury_wine_logo_image)).'"'.(!empty($luxury_wine_attr[3]) ? sprintf(' %s', $luxury_wine_attr[3]) : '').'>' ;
		} else {
			luxury_wine_show_layout(luxury_wine_prepare_macros($luxury_wine_logo_text), '<span class="logo_text">', '</span>');
			luxury_wine_show_layout(luxury_wine_prepare_macros($luxury_wine_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>