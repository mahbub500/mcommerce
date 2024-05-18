<?php 
use Mcommerce\Helper;

use Mcommerce\Include\App\Payment\Cart;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cart = new Cart;
$current_page_url 	= get_permalink();
$login_url 			= wp_login_url( $current_page_url );

if( ! is_user_logged_in() ) {
	echo sprintf(
        __('You need to be <a href="%s">logged in</a> to view your cart.', 'mcommerce'),
        $login_url
    );
	return;
}

if( false === ( $cart = $cart->get_contents() ) || count( $cart ) <= 0 ) {
	_e( 'Your cart is empty!', 'mcommerce' );
}
else {

	// echo '<div class="coschool-payment-wrapper">';
	echo '<h2>'. esc_html__( 'Order Summary', 'coschool' ) .'</h2>';
	do_action( 'mcommerce_cart' );
	do_action( 'mcommerce_payment_form' );
	
}
?>