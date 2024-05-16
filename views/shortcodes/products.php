<?php

use Mcommerce\Helper;
use Mcommerce\Include\App\Product\Data as Prodcuts_data;

$procuts =  Helper::get_posts( [ 
	'post_type' 		=> 'product',
	'post_status' 		=> 'publish', 
	// 'posts_per_page'	=> $args['count'],
	// 'author' 			=> $args['instructor'],
	// 'course-category'	=> $args['category'],
	'meta_query'		=> [
		[
			'key' 		=> 'mc_product_quantity',
			'compare' 	=> 'LIKE'
        ],
        [
			'key' 		=> 'mc_product_price',
			'compare' 	=> 'LIKE'
        ],

	]

] );
?>
<div class="container-fluid">
    <div class="row"> 
       
        <?php  foreach ( $procuts as  $id => $title ) { 

        $product_data 	    = new Prodcuts_data( $id );
        $permalink   	    = get_permalink( $id );
        $product_content    = $product_data->product->post_content ;
        $post_image         = get_the_post_thumbnail_url( $product_data->post ) ;
            
        ?>
        <div class="col-md-6">   
            <div class="card ml-2" style="width:400px ">
                <img class="card-img-top img-thumbnail rounded" style=" height: 300px; " src=" <?php echo $post_image ?> " alt="Product Image image">
                <div class="card-body">
                    <h2 class="card-title"><a href="<?php esc_attr_e( $permalink ); ?>"><?php esc_html_e( $title ) ?></a></h2>
                    <p class="card-text">Details :  <?php echo $product_content ?> </p>
                    <p>Price : <?php echo $product_data->get( 'mc_product_price' ) ?> </p>
                    <p>Quantity Remain : <?php echo $product_data->get( 'mc_product_quantity' ) ?> </p>
                    
                    <a href="<?php echo esc_url( $product_data->get( 'purchase_url' ) ) ?>" class="btn btn-primary">Add to cart</a>                  
                </div>
            </div>
            
            </div>             
        <?php } ?>
        
        
    </div>
</div>


