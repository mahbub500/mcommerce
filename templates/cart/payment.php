<?php
echo "Payment";

$payment_method = mcommerce_payment_method();
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
            <form >
                <div class='mc_srtipe' >
                    <div class="form-group " >
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </div>    
                <button type="submit" class="btn btn-primary mt-2">Bye Now</button>
            </form>
            <?php                                
            }
            ?>
            
        </div>
    </div>
</div>
