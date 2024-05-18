<?php
namespace Mcommerce\Include\App;

use Mcommerce\Helper;
use Mcommerce\Base;

use Mcommerce\Include\App\Payment\Method\Stripe;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Admin
 * @author Mahbub <mahbub.dev>
 */
class Payment {

	public $plugin;
	
	/**
	 * Plugin instance
	 * 
	 * @access private
	 * 
	 * @var Plugin
	 */
	private static $_instance;

	/**
	 * Constructor function
	 */
	public function __construct() {
		add_action( 'init', [ new Payment\Cart, 'loader' ] );
		add_action( 'mcommerce-cart_form_submitted', [ new Payment\Cart, 'process_cart' ] );

		add_action( 'init', [ new Stripe, 'redirect' ] );
		add_action( 'wp_footer', [ new Stripe, 'enqueue_scripts' ] );
		
		// add_action( 'coschool_payment_form_paypal', [ new Stripe, 'payment_form' ] );
		// add_filter( 'coschool_paypal_payment_id', [ new Stripe, 'payment_id' ], 10, 2 );
		// add_filter( 'coschool_payment_paypal_config', [ new Stripe, 'settings' ] );
	}

    

	/**
	 * Instantiate the plugin
	 * 
	 * @access public
	 * 
	 * @return $_instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}