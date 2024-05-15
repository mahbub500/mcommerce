<?php
namespace Mcommerce\Include\App;

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
class Product {

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
		add_action( 'init', [ new Product\Post_Type, 'register_post_type' ] );
		add_action( 'wp_head', [ new Product\Data, 'show_schema' ] );
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