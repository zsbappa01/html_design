<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;


// start: modified by Arlind
global $wp_query;

if ( ! get_data('shop_add_to_cart_listing') || get_data('shop_catalog_mode') ) {
	return;
}

$add_to_cart_link_attrs = array();
$is_textual = get_data( 'shop_add_to_cart_textual' );

if ( in_array( 'wishlist-action', array_keys( $wp_query->query ) ) || ( is_ajax() && isset( $_REQUEST['remove_from_wishlist'] ) ) ) {
	$is_textual = true;
}

if ( ! $is_textual ) {
	$add_to_cart_link_attrs[] = 'data-toggle="tooltip"';
	$add_to_cart_link_attrs[] = 'data-placement="' . ( is_rtl() ? 'right' : 'left' ) . '"';
	$add_to_cart_link_attrs[] = 'data-title="' . $product->add_to_cart_text() . '"';
	$add_to_cart_link_attrs[] = 'data-title-loaded="' . __('Product added to cart!', 'aurum') . '"';
} else {
	if ( isset( $class ) ) {
		$class .= ' is-textual';
	} else {
		$class = ' is-textual';
	}
}
$type = $product->get_type();
$class .= " product-type-{$type}";
// end: modified by Arlind

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s" ' . implode( ' ', $add_to_cart_link_attrs ) . '>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( $is_textual ? $product->add_to_cart_text() : '' ) // Modified by Arlind Nushi
	),
$product );
