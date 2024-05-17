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
class Template extends Base {

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
    
    public function load(  ){            
        $this->action( 'mcommerce_cart', 'cart' );
		$this->action( 'mcommerce_payment_form', 'payment_form' );
    
    }

    public function cart(){
       echo  Helper::get_view( 'cart', 'templates/cart' );
    }
	
	public function payment_form(){
       echo  Helper::get_view( 'payment', 'templates/cart' );
    }
	
}