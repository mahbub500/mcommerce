<?php
namespace Mcommerce\Include\App\Product;

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
 * @subpackage Admin
 * @author Mahbub <mahbub.dev>
 */
class Data extends Post_Data {

    /**
	 * @var obj
	 */
	public $product;

    /**
	 * Constructor function
	 * 
	 * @param int|obj $product the product
	 */
	public function __construct( $product ) {
		$this->product = get_post( $product );
		parent::__construct( $this->product );
	}

	/**
	 * URL to purchase a product
	 * 
	 * @since 0.9
	 * 
	 * @return string the URL
	 */
	public function get_purchase_url() {
		
		$key		= 'cart';
		// $key		= $this->get_type() == 'free' ? 'access' : 'enroll';

		return $enroll_url = add_query_arg( $key, $this->get( 'id' ), trailingslashit( mcommerce_cart_page( true ) ) );

	}


	/**
	 * Product Title
	 * 
	 * @since 0.9
	 * 
	 * @return string the URL
	 */
	public function get_product_title() {
		return get_the_title( $this->get( 'id' ) );

	}
}