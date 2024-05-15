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

        echo '<label for="my_meta_box_field">Description for this field</label>';
        echo '<input type="text" id="my_meta_box_field" name="my_meta_box_field" value="test" size="25" />';


        
    }

    public function save(){
    }

}