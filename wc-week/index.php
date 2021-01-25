<?php
/**
 * Plugin Name: WooCommerce Weekly Products
 * Description: Schedule WooCommerce Weekly Products
 * Plugin URI: https://vicodemedia.com
 * Author: Victor Rusu
 * Version: 0.0.1
**/

//* Don't access this file directly
defined( 'ABSPATH' ) or die();

//* Register activation hook to add Blog Manager role
// register_activation_hook( __FILE__ , 'vm_activation' );

//* Register deactivation hook to remove Blog Manager role
// register_deactivation_hook( __FILE__ , 'vm_deactivation' );

// remove quantity from all products
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
function wc_remove_all_quantity_fields( $return, $product ) 
{
    return( true );
}

// remove sidebar from product page
function njengah_remove_sidebar( $is_active_sidebar, $index ) {              
    if( $index !== "sidebar-1" ) {
        return $is_active_sidebar;
    }
    if( ! is_product() ) {
        return $is_active_sidebar;
    }
    return false;
}
add_filter( 'is_active_sidebar', 'njengah_remove_sidebar', 10, 2 );

// remove related products from product page
add_action('init', 'vm_remove_related');
function vm_remove_related(){
    echo '
    <style>
        .related{
            display:none!important;
        }
    </style>
    ';
}

// get current product
add_filter( 'product_type_selector', 'misha_remove_grouped_and_external' );
 
function misha_remove_grouped_and_external( $product_types ){
 
	// unset( $product_types['grouped'] );
	// unset( $product_types['external'] );
	//unset( $product_types['variable'] );
 
	print_r( $product_types );
}