<?php
use Mcommerce\Include\App\Product\Data;

$cart = mcommerce_get_cart_items();


?>

<div class="contaner">
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Queantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $cart as $product_id ) : 
                       
                    $product_data 	= new Data( $product_id );
                    $product_title = $product_data->get( 'product_title' );
                    $product_price 	= $product_data->get( 'mc_product_price' ); 

                    ?>
                        
                        <tr>
                            <td><?php echo $product_title?></td>
                            <td><?php echo $product_price ?></td>
                            <td>1</td>
                        </tr>
                    <?php endforeach; ?>                      
                </tbody>
            </table>
        </div>
    </div>
</div>