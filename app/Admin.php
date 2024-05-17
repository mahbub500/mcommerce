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

	public $admin_css;
	

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= time();
		$this->admin_css= $this->plugin['assets'] . '/css';
		$this->admin_js = $this->plugin['assets'] . '/js';
		$this->database = new DB();
	}

	public function install() {
		$this->database->create_tables();
	}

	 /**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'MCOMMERCE_DEBUG' ) && MCOMMERCE_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug. '-admin', "{$this->admin_css}/admin{$min}.css", '', $this->version, 'all' );

		wp_enqueue_style( 'boostrap' . '-admin', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css", '', $this->version, 'all' );

		wp_enqueue_script( $this->slug. '-admin', "{$this->admin_js}/admin{$min}.js", [ 'jquery' ], $this->version, true );

		wp_enqueue_script( 'boostrap-js', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js", [ 'jquery' ], $this->version, true );
		wp_enqueue_script( 'sweetalert2', "https://cdn.jsdelivr.net/npm/sweetalert2@11", '', $this->version, true );

		wp_enqueue_script( 'boostrap-bundle-js', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js", [ 'jquery' ], $this->version, true );

		$localized = [
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'		=> wp_create_nonce( $this->slug ),
			
		];	
		
		wp_localize_script( $this->slug. '-admin', 'MCOMMERCE', apply_filters( "{$this->slug}-localized", $localized ) );

	}

	public function modal(){
		?>
		<div id="admin-mcommerce-modal" style="display: none">
			<button class="btn btn-primary" type="button" disabled>
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			Loading...
			</button>
		</div>
		
		<?php
	}
}