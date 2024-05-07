<?php
namespace Mcommerce\App;

use Mcommerce\Base;
use Mcommerce\Helper;
use Mcommerce\Abstracts\DB;

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
		$this->database = new DB();
	}

	public function install() {
		$this->database->create_tables();
	}
}