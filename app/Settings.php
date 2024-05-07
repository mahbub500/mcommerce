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

    /**
     * Reginster post type
     */

     function register_post_type() {
        $labels = array(
			'name'               	=> __( 'Products', 'mcommerce' ),
			'singular_name'      	=> __( 'Product', 'mcommerce' ),
			'add_new'            	=> _x( 'Add New Product', 'mcommerce', 'mcommerce' ),
			'add_new_item'       	=> __( 'Add New Product', 'mcommerce' ),
			'edit_item'          	=> __( 'Edit Product', 'mcommerce' ),
			'new_item'           	=> __( 'New Product', 'mcommerce' ),
			'view_item'          	=> __( 'View Product', 'mcommerce' ),
			'search_items'       	=> __( 'Search Products', 'mcommerce' ),
			'not_found'          	=> __( 'No Products found', 'mcommerce' ),
			'not_found_in_trash' 	=> __( 'No Products found in Trash', 'mcommerce' ),
			'menu_name'          	=> __( 'Products', 'mcommerce' ),
			'featured_image'     	=> __( 'Image', 'mcommerce' ),
			'set_featured_image' 	=> __( 'Add Image', 'mcommerce' ),
			'remove_featured_image'	=> __( 'Remove Image', 'mcommerce' ),
		);
	
		$args = array(
			'labels'				=> $labels,
			'hierarchical'			=> false,
			'description'			=> 'description',
			'taxonomies'			=> array(),
			'public'				=> false,
			'show_ui'				=> true,
			'show_in_admin_bar'		=> true,
			'menu_position'			=> null,
			'menu_icon'				=> null,
			'show_in_nav_menus'		=> true,
			'publicly_queryable'  	=> true,
			'exclude_from_search' 	=> true,
			'has_archive'			=> false,
			'query_var'				=> true,
			'can_export'			=> true,
			'capability_type'		=> 'post',
			'supports'				=> array( 'title', 'editor', 'thumbnail' ),
		);
	
		register_post_type( 'products', $args );
    }
   
}