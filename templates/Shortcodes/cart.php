<?php 
use Mcommerce\Helper;

if( false === ( $cart = mcommerce_get_cart_items() ) || count( $cart ) <= 0 ) {
	_e( 'Your cart is empty!', 'mcommerce' );
}
else {

	// echo '<div class="coschool-payment-wrapper">';
	echo '<h2>'. esc_html__( 'Order Summary', 'coschool' ) .'</h2>';
	Helper::pri( $cart );
	// do_action( 'coschool_enroll_cart' );
	// do_action( 'coschool_enroll_payment_form' );
	
	// echo '</div>';
    echo '<div > Hello</div>';
}
?>