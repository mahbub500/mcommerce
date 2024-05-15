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
		$this->plugin					= get_plugin_data( MCOMMERCE );
		$this->plugin['basename']		= plugin_basename( MCOMMERCE );
		$this->plugin['file']			= MCOMMERCE;

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
			// $admin->action( 'admin_footer', 'upgrade' );
			// $admin->action( 'admin_footer', 'modal' );
			// $admin->action( 'plugins_loaded', 'i18n' );
			// $admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
			// $admin->action( 'admin_menu', 'add_menus' );
			// $admin->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );
			// $admin->filter( 'plugin_row_meta', 'plugin_row_meta', 10, 2 );
			// $admin->action( 'admin_footer_text', 'footer_text' );			
			// $admin->action( 'after_setup_theme', 'setup' );
			// $admin->action( 'admin_enqueue_scripts', 'enqueue_scripts' );
 			// $admin->action( 'plugins_loaded', 'settings_page_redirect' );			
 			// $admin->filter( 'http_request_host_is_external', '__return_true', 10, 3 );
 			// $admin->action( 'admin_notices', 'admin_notices' );
 			// $admin->action( 'cx-plugin_after-nav-items', 'setting_navs_add_item' );
 			// $admin->filter( 'admin_body_class', 'admin_body_class' );
 			// $admin->filter( 'admin_footer', 'admin_notice' );

			/**
			 * Settings related hooks
			 */
			$settings = new Settings( $this->plugin );
			$settings->action( 'init', 'register_post_type', 11 );
			// $settings->action( 'cx-settings-saved', 'reset',10, 2 );
			// $settings->action( "{$this->plugin['TextDomain']}_upgraded", 'migrate_settings', 10, 2 );

			/**
			 * Renders different notices
			 * 
			 * @package Codexpert\Plugin
			 * 
			 * @author Codexpert <hi@codexpert.io>
			 */
			// $notice = new Notice( $this->plugin );

			/**
			 * Shows a popup window asking why a user is deactivating the plugin
			 * 
			 * @package Pluggable\Marketing
			 * 
			 * @version 3.12
			 *
			 * @author Codexpert <hi@codexpert.io>
			 */
			// $deactivator = new Deactivator( CODESIGNER );
		

		else : // ! is_admin() ?

			/**
			 * Front facing hooks
			 */
			$front = new Front( $this->plugin );
			$front->action( 'wp_head', 'head' );
			$front->action( 'wp_enqueue_scripts', 'enqueue_scripts' );
			
		

		endif;

		/**
		 * The App loader
		 * 
		 * Loads actual app
		 */
		$app = new App( $this->plugin );
		$app->action( 'plugins_loaded', 'load' );

		
		/**
		 * Modules related hooks
		 */
		// $modules = new App\Modules( $this->plugin );
		// $modules->action( 'plugins_loaded', 'init' );

		// /**
		//  * The setup wizard
		//  */
		// $wizard = new App\Wizard( $this->plugin );
		// $wizard->action( 'admin_print_styles', 'enqueue_styles' );
		// $wizard->action( 'admin_print_scripts', 'enqueue_scripts' );
		// $wizard->action( 'plugins_loaded', 'render' );
		// $wizard->filter( "plugin_action_links_{$this->plugin['basename']}", 'action_links' );

		/**
		 * Cron facing hooks
		 */
		// $cron = new App\Cron( $this->plugin );
		// $cron->activate( 'install' );
		// $cron->deactivate( 'uninstall' );

		/**
		 * AJAX related hooks
		 */
		// $ajax = new App\AJAX( $this->plugin );
		// $ajax->priv( 'codesigner-docs_json', 'fetch_docs' );
		
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