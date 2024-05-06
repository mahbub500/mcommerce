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
class Front extends Base {

	public $plugin;

	public $slug;

	public $name;

	public $version;

	public $assets;
	

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
		$this->assets 	= MCOMMERCE_ASSETS;

	}

    public function head(){
        // Helper::pri( $this->plugin['file'] );
    }

    /**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'MCOMMERCE_DEBUG' ) && MCOMMERCE_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug, "{$this->assets}/css/front{$min}.css", '', $this->version, 'all' );

		wp_enqueue_style( 'boostrap', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css", '', $this->version, 'all' );

		wp_enqueue_script( $this->slug, "{$this->assets}/js/front{$min}.js", [ 'jquery' ], $this->version, true );

		wp_enqueue_script( 'boostrap-js', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js", [ 'jquery' ], $this->version, true );

		wp_enqueue_script( 'boostrap-bundle-js', "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js", [ 'jquery' ], $this->version, true );

		$localized = [
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'		=> wp_create_nonce( $this->slug ),
			
		];
		
		wp_localize_script( $this->slug, 'MCOMMERCE', apply_filters( "{$this->slug}-localized", $localized ) );
	}
}