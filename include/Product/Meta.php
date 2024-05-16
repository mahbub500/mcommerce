<?php
namespace Mcommerce\Include\App\Product;

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
class Meta {

    
	/**
	 * Generates content metabox
	 * 
	 * @uses add_meta_box()
	 */
	public function content() {
		// add_meta_box( 'product-content', __( 'Product price', 'mcommerce' ), [ $this, 'callback_content' ], 'mc_procuct', 'normal', 'high' );

        add_meta_box( 'product-content', __( 'Product price', 'mcommerce' ), [ $this, 'callback_content' ], 'product', 'normal', 'high' );
	}

    public function callback_content( $post ){
        echo Helper::get_view( 'content', 'views/products' ); 
    }

    public function save( $product_id, $product ){

        $course_data = new Data( $product_id );

        // remove old meta from all content
		global $wpdb;
		
		$wpdb->delete( $wpdb->postmeta, [ 'meta_key' => 'product_id', 'meta_value' => $product_id ] );

        // update course contents
		if( isset( $_POST['mc_product_price'] ) ) :
			$new_contents	= $_POST['mc_product_price'];
			$course_data->set( 'mc_product_price', mcommerce_sanitize( $new_contents, 'array' ) );

			// update new meta to all content
			if( ! empty( $new_contents ) ) :
			foreach ( $new_contents as $chapter => $contents ) {
				foreach ( $contents as $content_id ) {
					update_post_meta( $content_id, 'product_id', $product_id ); // @TODO replace with `Data` object or an SQL query
				}
			}
			endif;
		endif;

    }

}