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
 * @subpackage Admin
 * @author Mahbub <mahbub.dev>
 */
class Ajax extends Base {

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

	public function save_page_id() {
        update_option( 'mcommerce_save_page__', 1 );
        if( ! wp_verify_nonce( $_POST['_wpnonce'], $this->slug ) ) {
            $response['status']		= 0;
            $response['message'] 	= __( 'Unauthorized!', 'mcommerce' );
            wp_send_json( $response );
        }

        update_option( 'mcommerce_page_id', $_POST['page_id'] );
        update_option( 'mcommerce_payment_id', $_POST['payment'] );

        $response['status']		= 1;
        $response['message'] 	= __( 'Page Updated!', 'mcommerce' );
        wp_send_json( $response );
        
		
	}
}