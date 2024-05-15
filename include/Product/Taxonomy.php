<?php
namespace Mcommerce\Include\App\Product;

use Mcommerce\Helper;
use Mcommerce\Base;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Taxonomy {

	public function register() {
	
		$category_labels = array(
			'name'                  => _x( 'Categories', 'Taxonomy plural name', 'mcommerce' ),
			'singular_name'         => _x( 'Category', 'Taxonomy singular name', 'mcommerce' ),
			'search_items'          => __( 'Search Categories', 'mcommerce' ),
			'popular_items'         => __( 'Popular Categories', 'mcommerce' ),
			'all_items'             => __( 'All Categories', 'mcommerce' ),
			'parent_item'           => __( 'Parent Category', 'mcommerce' ),
			'parent_item_colon'     => __( 'Parent Category', 'mcommerce' ),
			'edit_item'             => __( 'Edit Category', 'mcommerce' ),
			'update_item'           => __( 'Update Category', 'mcommerce' ),
			'add_new_item'          => __( 'Add New Category', 'mcommerce' ),
			'new_item_name'         => __( 'New Category Name', 'mcommerce' ),
			'add_or_remove_items'   => __( 'Add or remove Categories', 'mcommerce' ),
			'choose_from_most_used' => __( 'Choose from most used Categories', 'mcommerce' ),
			'menu_name'             => __( 'Category', 'mcommerce' ),
		);
	
		$category_args = array(
			'labels'            => $category_labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_tagcloud'     => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => true,
			'query_var'         => true,
			'capabilities'      => array(),
		);
	
		register_taxonomy( 'product-category', array( 'product' ), $category_args );	
		
	}
}