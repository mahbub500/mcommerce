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
				card.mount('.mc_card');
				$(document).on( 'click', '.mcommerce-payment-button-stripe', function (e) {
					e.preventDefault();
					$('#front-mcommerce-modal').show();
                    stripe.createToken(card).then(function(result) {
						if (result.error) {
                            console.log(result.error.message);							
						}
						else {
							console.log(result);
							$('#mcommerce-stripe-token').val(result.token.id);
							$('#front-mcommerce-modal').hide();
							$('#mcommerce-payment-form').submit();
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

	
}
