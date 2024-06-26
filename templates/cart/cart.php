<?php
use Mcommerce\Include\App\Product\Data;
use Mcommerce\Helper;
use Mcommerce\Include\App\Payment\Cart;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cart           = new Cart;
$cart_item      = $cart->get_contents();
$cart_total     = $cart->get_total();

?>
<div class="contaner">
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $cart_item as $product_id ) : 
                       
                    $product_data 	= new Data( $product_id );
                    $product_title  = $product_data->get( 'product_title' );
                    $product_price 	= $product_data->get( 'mc_product_price' );                     

                    ?>                        
                        <tr>
                            <td><?php echo $product_title?></td>                            
                            <td>1</td>
                            <td><?php echo $product_price ?></td>
                            <td><a href="<?php echo esc_url( add_query_arg( 'delist', $product_id ) )  ?>" >&#10005</a> </td>
                        </tr>
                    <?php endforeach; ?> 
                    <tr>
                        <td></td>                        
                        <td>Total</td>
                        <td> <?php echo $cart_total  ?> </td>
                        <td></td>
                    </tr>                     
                </tbody>
            </table>
        </div>
    </div>
</div>