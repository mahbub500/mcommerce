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
        if( isset( $_GET['cart'] ) && get_post_status( $product_id = mcommerce_sanitize( $_GET['cart'] ) ) ) {

            $this->add_product( $product_id );
            $cart_page_id = mcommerce_cart_page();

            do_action( 'mcommerce-product_added_to_cart', $product_id );
            
            wp_safe_redirect( get_permalink( $cart_page_id ) );
            exit();
        }
        
        
        // removing a product from the cart
        if( isset( $_GET['delist'] ) && get_post_status( $product_id = mcommerce_sanitize( $_GET['delist'] ) ) ) {
            $cart_page_id = mcommerce_cart_page();

            $this->remove_product( $product_id );

            do_action( 'mcommerce-product_removed_from_cart', $product_id );
            
            wp_safe_redirect( get_permalink( $cart_page_id ) );
            exit();
        }      
        
    }

    /**
     * Adds a course to the cart
     * 
     * @param int $product_id
     */
    public function remove_product( $product_id ) {

        if( false === ( $cart = $this->get_contents() ) ) {
            return;
        }

        if( in_array( $product_id, $cart ) && ( $key = array_search( $product_id, $cart ) ) !== false ) {
            unset( $cart[ $key ] );
        }

        setcookie( $this->cart_key , serialize( array_unique( $cart ) ), time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
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

    /**
     * Gets the cart
     * 
     * @return [int] An array of IDs
     */
    public function get_contents() {
        if( isset( $_COOKIE[ $this->cart_key ] ) ) {
            return unserialize( stripslashes( mcommerce_sanitize( $_COOKIE[ $this->cart_key ] ) ) );
        }

        return false;
    }
}