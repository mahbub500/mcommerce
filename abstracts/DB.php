<?php
namespace Mcommerce\Abstracts;

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
class Db {

	/**
     * @var obj $wpdb
     */
    public $db;

    /**
     * Database table prefix
     * 
     * @var string
     */
    public $prefix;

    /**
     * Constructor function
     * 
     * @uses $wpdb
     */
    public function __construct() {
        global $wpdb;

        $this->db = $wpdb;

        $this->prefix = mcommerce_db_prefix();
    }

     /**
     * Create database tables
     * 
     * @since 0.9
     */
    public function create_tables() {

        $charset_collate = $this->db->get_charset_collate();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		/**
		 * product table
		 */
		$product_table = "CREATE TABLE `{$wpdb->prefix}{$this->prefix}product` (
		    id int(11) NOT NULL AUTO_INCREMENT,
		    name varchar(255) NOT NULL,
		    description varchar(255) NOT NULL,
		    price int(11) NOT NULL,
		    quantity int(11) NOT NULL,
		    image varchar(255) NULL,
		    created_by int(11) NOT NULL,
		    time int(10) NOT NULL,
		    UNIQUE KEY id (id)
		);";

		dbDelta( $product_table );
    }

	
}