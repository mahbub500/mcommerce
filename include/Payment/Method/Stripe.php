<?php

namespace Mcommerce\Include\App\Payment\Method;
use Mcommerce\Abstracts\Payment_Method;
// use Codexpert\CoSchool\Helper;
// use Codexpert\CoSchool\App\Course\Data as Course_Data;
// use Codexpert\CoSchool\App\Instructor\Data as Instructor_Data;
// use Codexpert\CoSchool\App\Payment\Cart;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
 
/**
 * @package Plugin
 * @subpackage Payment_Method
 * @author Codexpert <hi@codexpert.io>
 */
class Stripe extends Payment_Method {

	/**
	 * @var string
	 */
	public $method;

	/**
	 * @var string
	 */
	public $label;

	/**
	 * @var obj $wpdb
	 */
	public $database;

	/**
	 * @var bool $is_test Are we in sandbox mode?
	 */
	public $is_test;

	/**
	 * @var string $pay_url PayPal url
	 */
	public $pay_url;

	/**
	 * @var string $api_url PayPal API url
	 */
	public $api_url;

	/**
	 * @var string $paypal_email PayPal email
	 */
	public $paypal_email;

	/**
	 * @var string $currency_code Currency Code
	 */
	public $currency_code;

	/**
	 * Constructor function
	 * 
	 * @uses WP_Post class
	 * @param int|obj $method the method
	 */
	public function __construct() {

		$this->method	= 'stripe';
		$this->label	= __( 'Stripe', 'coschool' );

		$this->is_test 	= mcommerce_test_mode();

		$this->pay_url	= $this->is_test ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
		$this->api_base	= $this->is_test ? 'https://api.sandbox.paypal.com/v1' : 'https://api.paypal.com/v1';
		// $this->currency_code	= Helper::get_option( 'coschool_payment', 'currency' );
		// $this->clientId			= Helper::get_option( 'coschool_payment', 'paypal_clientId' );
		// $this->secret			= Helper::get_option( 'coschool_payment', 'paypal_secret' );
		// $this->paypal_email		= Helper::get_option( 'coschool_payment', 'paypal_email' );

		parent::__construct();
	}

	

	public function enqueue_scripts() {
        ?>
        <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
		<script type="text/javascript">
			jQuery(function($){
				var stripe = Stripe( '<?php echo get_option( 'stripe_publishable_key' ); ?>' );

				var elements = stripe.elements();

				var card = elements.create( 'card', { hidePostalCode: true, style: {} } );
				card.mount('.mc_srtipe');
				$(document).on( 'click', '.mcommerce-payment-button-stripe', function (e) {
					e.preventDefault();
                    stripe.createToken(card).then(function(result) {
						if (result.error) {
                            console.log(result.error.message);							
						}
						else {
							console.log(result);
							$('#coschool-stripe-token').val(result.token.id);
							$('#mcommerce-payment-form').submit();
							$('#coschool-modal').show();
						}
					});
				});
			});
		</script>
		<style type="text/css"> .StripeElement {background-color: white;padding: 10px 12px;border-radius: 4px;border: 1px solid transparent;box-shadow: 0 1px 3px 0 #e6ebf1;-webkit-transition: box-shadow 150ms ease;transition: box-shadow 150ms ease;} .StripeElement--focus {box-shadow: 0 1px 3px 0 #cfd7df;} .StripeElement--invalid {border-color: #fa755a;} .StripeElement--webkit-autofill {background-color: #fefde5 !important;}
		<?php
	}

	public function redirect() {

		// if it's from PayPal
		if(
			isset( $_POST['payment_status'] ) && 'Completed' == $_POST['payment_status'] &&
			isset( $_POST['txn_id'] ) && '' != $_POST['txn_id'] &&
			isset( $_POST['verify_sign'] ) && '' != $_POST['verify_sign'] &&
			isset( $_POST['payment_gross'] ) && '' != $_POST['payment_gross']
		)
		{
			
			wp_safe_redirect( add_query_arg(
			[
				'paypal-token'	=> coschool_sanitize( $_POST['txn_id'] ),
				'paypal-verify'	=> coschool_sanitize( $_POST['verify_sign'] ),
				'paypal-gross'	=> coschool_sanitize( $_POST['payment_gross'] ),
			], coschool_enroll_page( true ) ) );

        	exit();
		}
	}

	public function payment_form() {
		if(
			isset( $_GET['paypal-token'] ) && '' != $_GET['paypal-token'] &&
			isset( $_GET['paypal-verify'] ) && '' != $_GET['paypal-verify'] &&
			isset( $_GET['paypal-gross'] ) && '' != $_GET['paypal-gross']
		) { ?>
			<input type="hidden" name="paypal-txn_id" value="<?php echo coschool_sanitize( $_GET['paypal-token'] ); ?>" />
			<input type="hidden" name="paypal-verify_sign" value="<?php echo coschool_sanitize( $_GET['paypal-verify'] ); ?>" />
			<input type="hidden" name="paypal-payment_gross" value="<?php echo coschool_sanitize( $_GET['paypal-gross'] ); ?>" />
		<?php }
	}

	/**
	 * Let's process the payment
	 * 
	 * @param array $posted The form data
	 */
	public function payment_id( $payment_id, $posted ) {
		
		if(
			isset( $posted['paypal-txn_id'] ) &&

			isset( $posted['paypal-verify_sign'] ) &&

			isset( $posted['paypal-payment_gross'] ) &&

			! $this->database->is_found( 'paymentmeta', 'meta_value', coschool_sanitize( $posted['paypal-verify_sign'] ) )
		)
		{

			/**
			 * Verify with PayPal
			 * 
			 * @uses wp_remote_post()
			 * @uses wp_remote_get()
			 * 
			 * @since 0.9
			 */
			$token_response = wp_remote_post( $this->api_base . '/oauth2/token', [
			    'headers' => [
			        'Authorization' => "Basic " . base64_encode( $this->clientId . ':' . $this->secret )
			    ],
			    'body'    => [
			    	'grant_type'	=> 'client_credentials'
			    ],
			] );

			$token_response_body	= wp_remote_retrieve_body( $token_response );
			$token_response_json	= json_decode( $token_response_body );

			// If access_token cannot be generated, return the original $payment_id
			if( ! isset( $token_response_json->access_token ) ) {
				return $payment_id;
			}

			$txn_response = wp_remote_get( $this->api_base . "/payments/sale/" . coschool_sanitize( $posted['paypal-txn_id'] ), [
			    'headers' => [
			        'Authorization' => "Bearer {$token_response_json->access_token}"
			    ],
			] );

			$txn_response_body = wp_remote_retrieve_body( $txn_response );
			$txn_response_json = json_decode( $txn_response_body );

			// If txn_id cannot be verified, return the original $payment_id
			if( ! isset( $txn_response_json->state ) || $txn_response_json->state != 'completed' ) {
				return $payment_id;
			}

			/**

			 * Insert payment data

			 */
			$payment_id = $this->database->insert_payment( coschool_sanitize( $posted['paypal-payment_gross'] ), get_current_user_id(), $this->method, coschool_sanitize( $posted['paypal-txn_id'] ) );

	        /**

	         * Insert payment meta

	         */
	        $this->database->add_payment_meta( $payment_id, 'paypal-verify_sign', coschool_sanitize( $posted['paypal-verify_sign'] ) );

	        return $payment_id;
		}

		return $payment_id;
	}
}
