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

/**
 * @package Plugin
 * @subpackage Admin
 * @author Mahbub <mahbub.dev>
 */
class Post_Type  {

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
			'taxonomies'			=> array( 'product-category' ),
			'public'				=> true,
			'show_ui'				=> true,
			'show_in_admin_bar'		=> true,
			'menu_position'			=> 10,
			'show_in_nav_menus'		=> true,
			'publicly_queryable'  	=> true,
			'exclude_from_search' 	=> true,
			'query_var'				=> true,
			'can_export'			=> true,
			'capability_type'		=> 'post',
			'rewrite'             => array( 'slug' => 'product', 'with_front' => true ),
			'supports'				=> array( 'title', 'editor', 'thumbnail', 'author' ),
		);
	
		register_post_type( 'product', $args );
    }


	/**
	* Adds table column
	* 
	* @access public
	* 
 	* @param array $columns
 	* 
	* @return array $columns
	*/
	public function add_table_columns( $columns ) {

		unset( $columns['date'] );
		unset( $columns['comments'] );

		$columns['desc']							= __( 'Description', 'mcommerce' );
		$columns['price']							= __( 'Price', 'mcommerce' );
		$columns['quantity']						= __( 'Quantity', 'mcommerce' );
		$columns['iamge']							= __( 'Photo', 'mcommerce' );

		return $columns;
	}

	/**
	* Adds column content
	* 
	* @access public
	* 
 	* @param string $column the column id
 	* @param int $product_id item ID
	*/
	public function add_column_content( $column, $product_id ) {
		$product_data = new Data( $product_id );

		switch ( $column ) {		    

		    case 'price' :
		        echo false === ( $price = $product_data->get( 'price' ) ) ? esc_html__( 'Free', 'mcommerce' ) : coschool_price( $price );
		        break;
		}
	}
	
	/**
	* Course updated text
	* 
	* @access public
	* 
 	* @param string mesages
	*/
	public function course_updated_message( $messages ){
		
		$text 		= "<a href ='" . get_the_permalink() . "'>". esc_html__( 'View Course', 'coschool' ) ."</a>";

		$messages['course'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => esc_html__( 'Course updated. ', 'coschool') .  wp_kses_post( $text ) ,
			6  => esc_html__( 'Course created. ', 'coschool') .  wp_kses_post( $text ) ,
			10 => esc_html__( 'Course draft updated. ', 'coschool' ) .  wp_kses_post( $text ) ,
		);

		return $messages;
	}

	/**
	* Bulk Course delete text
	* 
	* @access public
	* 
 	* @param string mesages
	*/
	public function bulk_course_updated_message( $bulk_messages, $bulk_counts ){
		
	    $bulk_messages['course'] = array(
	        'updated'   => _n( '%s Course updated.', '%s Courses updated.', $bulk_counts['updated'], 'coschool' ),
	        'locked'    => _n( '%s Course not updated, somebody is editing it.', '%s Courses not updated, somebody is editing them.', $bulk_counts['locked'], 'coschool' ),
	        'deleted'   => _n( '%s Course permanently deleted.', '%s Courses permanently deleted.', $bulk_counts['deleted'], 'coschool' ),
	        'trashed'   => _n( '%s Course moved to the Trash.', '%s Courses moved to the Trash.', $bulk_counts['trashed'], 'coschool' ),
	        'untrashed' => _n( '%s Course restored from the Trash.', '%s Courses restored from the Trash.', $bulk_counts['untrashed'], 'coschool' ),
	    );
	 
	    return $bulk_messages;
	}

}