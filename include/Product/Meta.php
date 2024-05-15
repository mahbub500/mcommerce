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
        // echo Helper::get_view( 'content', 'views/products' );

        $product_id = $post->ID;

        $prodcut_price  = get_post_meta( $product_id, 'wc_product_price', true );

        echo '<label for="my_meta_box_field">Description for this field</label>';
        echo '<input type="number" id="wc_product_price" name="wc_product_price" value="'.$prodcut_price.'" size="25" />';


        
    }

    public function save( $product_id, $product ){

        if(   isset( $_POST['wc_product_price'] )   ){

            update_post_meta( $product_id, 'wc_product_price', $_POST['wc_product_price']  );

        }

    }

}