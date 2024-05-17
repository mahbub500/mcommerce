<?php
namespace Mcommerce\Include\App\Payment;

use Mcommerce\Helper;
use Mcommerce\Abstracts\DB;
use Mcommerce\Abstracts\Post_Data;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Payment
 * @author Mahbub <mahbub.dev>
 */
class Cart {

    /**
     * @var obj $wpdb
     */
    public $database;

    public $cart_key = 'mcommmerce_cart';

    public $coupon_key = 'mcommmerce_coupon';

    /**
     * Constructor function
     * 
     * @uses WP_Post class
     * @param int|obj $method the method
     */
    public function __construct() {
        $this->database = new DB;
    }

     /**
     * General loader for some early actions
     */
    public function loader() {
        
        // a product is being added to the cart
        if( isset( $_GET['enroll'] ) && get_post_status( $product_id = coschool_sanitize( $_GET['enroll'] ) ) ) {

            $this->add_product( $product_id );

            do_action( 'coschool-product_added_to_cart', $product_id );
            
            wp_safe_redirect( coschool_enroll_page( true ) );
            exit();
        }
        
        
        // removing a product from the cart
        if( isset( $_GET['delist'] ) && get_post_status( $product_id = coschool_sanitize( $_GET['delist'] ) ) ) {

            $this->remove_product( $cproduct_id );

            do_action( 'coschool-product_removed_from_cart', $product_id );
            
            wp_safe_redirect( coschool_enroll_page( true ) );
            exit();
        }      
        
    }

    /**
     * Adds a prodcut to the cart
     * 
     * @param int $product_id
     */
    public function add_product( $product_id ) {

        if( false === ( $cart = $this->get_contents() ) ) {
            $cart = [];
        }

        $cart[] = $product_id;

        setcookie(  $this->cart_key , serialize( array_unique( $cart ) ), time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    }
}