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
 * @subpackage Front
 * @author Mahbub <mahbub.dev>
 */
class Settings extends Base {

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

	public function sub_menu() {
		// add_submenu_page( 'product', __( 'Settings', 'mcommerce' ), __( 'Settings', 'coschool' ), 'manage_options', 'settings', [ $this, 'callback_reports' ] );
		add_submenu_page( 'edit.php?post_type=product', __( 'Settings', 'coschool' ), __( 'Settings', 'coschool' ), 'manage_options', 'settings', [ $this, 'callback_settings' ] );
	}

    public function callback_settings() {
        echo Helper::get_view( 'settings', 'views/adminmenu' );
    }

    
   
}