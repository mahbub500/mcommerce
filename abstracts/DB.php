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
		    trans_key varchar(255) NOT NULL,
		    order_by int(11) NOT NULL,
		    total int(11) NOT NULL,
		    UNIQUE KEY id (id)
		);";

		dbDelta( $order_table );
    }

	
}