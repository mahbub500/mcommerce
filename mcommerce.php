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
use Mcommerce\App\Front;
use Mcommerce\App\Admin;
use Mcommerce\App\App;
use Mcommerce\App\Settings;
use Mcommerce\App\Common;
use Mcommerce\App\Shortcode;
use Mcommerce\App\Ajax;
use Mcommerce\App\Template;

use Mcommerce\Include;
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

	public $slug;

	public $name;

	public $server;
	
	public $version;
	
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
		$this->define();

		/**
		 * Runs actual hooks
		 */
		$this->hook();
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
	 * Define variables and constants
	 * 
	 * @access private
	 * 
	 * @uses get_plugin_data
	 * @uses plugin_basename
	 */
	private function define() {

		/**
		 * Define some constants
		 * 
		 * @since 0.9
		 */
		define( 'MCOMMERCE', __FILE__ );
		define( 'MCOMMERCE_DIR', dirname( MCOMMERCE ) );
		define( 'MCOMMERCE_ASSETS', plugins_url( 'assets', MCOMMERCE ) );
		define( 'MCOMMERCE_DEBUG', apply_filters( 'mcommerce_debug', true ) );

		/**
		 * The plugin data
		 * 
		 * @since 0.9
		 * @var $plugin
		 */
		$this->plugin				= get_plugin_data( MCOMMERCE );
		$this->plugin['basename']	= plugin_basename( MCOMMERCE );
		$this->plugin['assets']		= MCOMMERCE_ASSETS;
		$this->plugin['file']		= MCOMMERCE;

	}
    /**
	 * Hooks
	 * 
	 * @access private
	 * 
	 * Executes main plugin features
	 *
	 * To add an action, use $instance->action()
	 * To apply a filter, use $instance->filter()
	 * To register a shortcode, use $instance->register()
	 * To add a hook for logged in users, use $instance->priv()
	 * To add a hook for non-logged in users, use $instance->nopriv()
	 * 
	 * @return void
	 */
	private function hook() {

		if( is_admin() ) :

			/**
			 * Admin facing hooks
			 */
			$admin = new Admin( $this->plugin );
			$admin->activate( 'install' );
			$admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );			
 			$admin->action( 'admin_footer', 'modal' );

			/**
			 * Settings related hooks
			 */
			$settings = new Settings( $this->plugin );			
			$settings->action( 'init', 'sub_menu' );	

		else : // ! is_admin() ?

			/**
			 * Front facing hooks
			 */
			$front = new Front( $this->plugin );
			$front->action( 'wp_head', 'head' );
			$front->action( 'wp_enqueue_scripts', 'enqueue_scripts' );
			$front->action( 'wp_footer', 'modal' );

			/**
			 * Short Code related hooks
			 */
			$shortcode = new Shortcode( $this->plugin );
			$shortcode->register( 'mcommerce_products', 'products' );
			$shortcode->register( 'mcommerce_cart', 'cart' );	

		endif;

		/**
		 * The App loader
		 * 
		 * Loads actual app
		 */
		$app = new App( $this->plugin );
		$app->action( 'plugins_loaded', 'load' );

		
		/**
		 * Common related hooks
		 */
		$common = new Common( $this->plugin );
		// $common->action( 'wp_enqueue_scripts', 'enqueue_scripts' );
		
		/**
		 * Template related hooks
		 */
		$template = new Template( $this->plugin );
		$template->action( 'plugins_loaded', 'load' );

		

		/**
		 * AJAX related hooks
		 */
		$ajax = new Ajax( $this->plugin );
		$ajax->all( 'save-page-id', 'save_page_id' );
		
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

Plugin::instance();