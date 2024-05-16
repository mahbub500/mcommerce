<?php 

use Mcommerce\Include\App\Product\Data;
global $post;
    $product_id = $post->ID;

    $product_data 	= new Data( $post->ID );
    $product_price 	= $product_data->get( 'mc_product_price' );
    $product_quantity	= $product_data->get( 'mc_product_quantity' );

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label >Product Price</label>
                    <input type="number" class="form-control" name="mc_product_price" value="<?php echo $product_price ?>" placeholder="Enter Product Price">   
                </div> 
                </div>
            <div class="col-md-2">
            <div class="form-group">
                <label >Product Quantity</label>
                <input type="number" class="form-control" name="mc_product_quantity" value="<?php echo $product_quantity ?>" placeholder="Enter Product Quantity">   
            </div>
            </div>   

            
        </div>
    </div>    
    <?php 
?>