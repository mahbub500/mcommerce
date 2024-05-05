<?php
/**
 * Plugin Name: MCommerce
 * Plugin URI: mahbub.dev
 * Description: A Super fast ecommerce system
 * Version: 0.9
 * Author: Mahbub
 * Author URI: mahbub.dev
 * Text Domain: mcommerce
 * Domain Path: /i18n/languages/
 * Requires at least: 6.3
 * Requires PHP: 7.4
 *
 * @package MCommerce
 */




namespace Mcommerce;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main class for the plugin
 * @package Plugin
 * @author MCommerce mahbub.dev
 */
final class Plugin {
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
	 * The constructor method
	 * 
	 * @access private
	 * 
	 * @since 0.9
	 */

	private function __construct() {

		/**
		 * Includes require_onced files
		 */
		$this->include();

		/**
		 * Defines constants
		 */
		// $this->define();

		/**
		 * Runs actual hooks
		 */
		// $this->hook();
	}

	/**
	 * Includes files
	 * 
	 * @access private
	 * 
	 * @uses composer
	 * @uses psr-4
	 */
	private function include() {
		require_once( dirname( __FILE__ ) . '/inc/functions.php' );
		require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );
	}



    /**
	 * Cloning is forbidden.
	 * 
	 * @access public
	 */
	public function __clone() { }

	/**
	 * Unserializing instances of this class is forbidden.
	 * 
	 * @access public
	 */
	public function __wakeup() { }

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