<?php 
use Mcommerce\Helper;

use Mcommerce\Include\App\Payment\Cart;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cart = new Cart;

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