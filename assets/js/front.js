let mcommerce_modal = (show = true) => {
    if (show) {
        jQuery("#front-mcommerce-modal").show();
    } else {
        jQuery("#front-mcommerce-modal").hide();
    }
};
jQuery(function ($) {

   $('#mc_front_payment').on('change', function(e){
    if( $(this).val() == 1) {
        $('.mc_srtipe').hide();
    }
    if( $(this).val() == 2) { 
        $('.mc_srtipe').show();
    } 
   });
   
});

