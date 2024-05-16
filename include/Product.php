<?php
namespace Mcommerce\Include\App;

use Mcommerce\Helper;
use Mcommerce\Base;

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
		$post_type = 'product';
		add_action( 'init', [ new Product\Post_Type, 'register_post_type' ] );
		add_action( 'manage_'. $post_type .'_posts_columns', [ new Product\Post_Type, 'add_table_columns' ] );

		
		add_action( 'manage_'. $post_type .'_posts_custom_column', [ new Product\Post_Type, 'add_column_content' ], 10, 2 );
		
		add_action( 'init', [ new Product\Taxonomy, 'register' ] );

		add_action( 'add_meta_boxes', [ new Product\Meta, 'content' ], 11 );
		add_action( 'save_post_'. $post_type , [ new Product\Meta, 'save' ], 10, 2 );


		// add_action( 'wp_head', [ new Product\Post_Type, 'show_schema' ] );
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