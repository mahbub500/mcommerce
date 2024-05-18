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

