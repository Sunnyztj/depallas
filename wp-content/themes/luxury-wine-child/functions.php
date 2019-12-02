<?php
/**
 * Child-Theme functions and definitions
 */
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' ); 
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_filter( 'woocommerce_product_add_to_cart_text',		'luxury_wine_woocommerce_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text','luxury_wine_woocommerce_add_to_cart_text' );
//function luxury_wine_woocommerce_add_to_cart_text($text='') {
//	return esc_html__('了解更多', 'luxury-wine');
//}

function luxury_wine_woocommerce_add_to_cart_text($text='') {
        $current_site = home_url();
        if ( $current_site == 'http://depallas.com.au' )
        {
                return esc_html__('Learn More', 'luxury-wine');
        }
        else
        {
                return esc_html__('了解更多', 'luxury-wine');
        }
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}




?>
