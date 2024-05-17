<?php

use Mcommerce\Helper;

$args = [
    'post_type' => 'page',
    'posts_per_page' => -1, // Get all pages
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC'
];

$pages = Helper::get_posts( $args );
$cart_page_id = mcommerce_cart_page();

// Helper::pri( $pages );
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mt-5">
        <form >  
            <div class="form-row">            
                <div class="form-group col-md-4">
                <label for="mc_page">Add Cart Page </label>
                <select id="mc_page" class="form-control">
                    <option selected value="0">Choose Page For Cart</option>
                    <?php foreach ( $pages as $id => $page ) : ?>                        
                        <option <?= $cart_page_id == $id ? 'selected' : '' ?> value="<?= $id ?>"><?= $page ?></option>
                    <?php endforeach; ?>
                </select>
                </div>        
            </div>
        <button class="btn btn-primary mc-submit">Save Settings</button>
        </form>
        </div>
    </div>
</div>
