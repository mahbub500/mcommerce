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
class App extends Base {

	public $plugin;

	public $slug;
	
	public $name;

	public $version;

	public $modules;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
		
		$this->modules = [ 
			__( 'Product', 'mcommerce' ), 
			
		];
	}

	public function load() {

		foreach ( $this->modules as $module ) {
		
			$class_name = 'Mcommerce\Include\App\\'. $module;
			if( class_exists( $class_name ) ) {
				$class_name::instance();
			}
		}
	}
}