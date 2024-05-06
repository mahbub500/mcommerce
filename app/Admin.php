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
class Admin extends Base {

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

	public function install(){

		update_option( 'test', 'install' );

		/**
		 * Create database tables
		 */
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		/**
		 * product table
		 */
		$product_table = "CREATE TABLE `{$wpdb->prefix}_mc_product` (
		    id int(11) NOT NULL AUTO_INCREMENT,
		    name varchar(255) NOT NULL,
		    description varchar(255) NOT NULL,
		    price int(11) NOT NULL,
		    quantity int(11) NOT NULL,
		    image varchar(255) NULL,
		    created_by int(11) NOT NULL,
		    create_date varchar(255) NOT NULL,
		);";

		dbDelta( $product_table );
	}
}