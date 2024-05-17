<?php
namespace Mcommerce\App;

use Mcommerce\Base;
use Mcommerce\Helper;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author Mahbub <mahbub.dev>
 */
class Shortcode extends Base {

	public $plugin;

	public $slug;

	public $name;

	public $version;
	

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];

	}
    
    public function products(  ){            

        return Helper::get_view( 'products', 'views/shortcodes' );
    
    }

	/**
	 * Course enrollment form
	 * 
	 * @since 0.9
	 */
	public function cart() {
		// // if native payment is not enabled, abort
		// if( 'native' != coschool_payment_handler() && 'test-payment' != coschool_payment_handler()  ) {
		// 	return __( 'Something went wrong!', 'coschool' );
		// }

		return Helper::get_view( 'cart', 'templates/shortcodes' );
	}
}