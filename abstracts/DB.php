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
		 * order table
		 */
		$order_table = "CREATE TABLE `{$wpdb->prefix}{$this->prefix}order` (
		    id int(11) NOT NULL AUTO_INCREMENT,		  
		    price int(11) NOT NULL,
		    quantity int(11) NOT NULL,
		    status varchar(255) NULL,
		    order_by int(11) NOT NULL,
		    trans_key varchar(11) NOT NULL,
		    time int(10) NOT NULL,
		    UNIQUE KEY id (id)
		);";

		dbDelta( $order_table );
    }

	
}