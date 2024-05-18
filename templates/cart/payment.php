<?php

use Mcommerce\Include\App\Payment\Cart;
echo "Payment";

$payment_method = mcommerce_payment_method();

$user_id = get_current_user_id();
$user_info = get_userdata( $user_id );

$cart           = new Cart;
$cart_total     = $cart->get_total();

?>
<div class="contaner">
    <div class="row">
        <div class="col-md-8">
        <div class="dropdown">                      
            <?php
            if( $payment_method == '1' ) {
                ?>
                <form action="" >

                </form>
                <button type="submit" class="btn btn-primary mt-2">Bye Now</button>
                <?php
                
                
            }else{
                ?>
            <form id="mcommerce-payment-form" method="post" >
                <?php wp_nonce_field();?>
                <input type="hidden" id="mcommerce-stripe-token" name="stripeToken" />
                <input type="hidden" name="mcommerce-cart" value="1">
                <input type="hidden" name="order-total" value="<?php echo $cart_total; ?>">
                <div class='mc_srtipe' >
                    <div class="form-group " >
                        <label for="mc_user_name">User Name</label>
                        <input readonly type="text" value="<?php echo $user_info->user_login;?>" class="form-control" id="mc_user_name" >                        
                    </div> 
                    <div class="form-group " >
                        <label for="mc_user_email">Email address</label>
                        <input readonly type="email" value="<?php echo $user_info->user_email;?>" class="form-control" id="mc_user_email" >                        
                    </div>
                    <div class="mc_card">                        
                    </div>
                </div>    
                <button class="btn btn-primary mt-2 mcommerce-payment-button-stripe">Bye Now</button>
            </form>
            <?php                                
            }
            ?>
            
        </div>
    </div>
</div>
