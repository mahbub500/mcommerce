let mcommerce_modal = (show = true) => {
    if (show) {
        jQuery("#admin-mcommerce-modal").show();
    } else {
        jQuery("#admin-mcommerce-modal").hide();
    }
};

jQuery(function ($) {
    $('.mc-submit').click(function (e) {
        e.preventDefault();
        var page_id = $('#mc_page').val();

        if ( page_id == 0 ) {
            alert( 'Please select a page.' );
            return;
        };
        mcommerce_modal();

        // alert( MCOMMERCE );
        $.ajax({
            url: MCOMMERCE.ajaxurl, // The correct place for the URL
            type: 'POST',
            data: { 
                action: "save-page-id", // The action name
                page_id: page_id,
                _wpnonce: MCOMMERCE._wpnonce 
            },
            dataType: 'json',
            success: function(resp) {
                Swal.fire({
                    title: "Good job!",
                    text: "You Select a page for cart",
                    icon: "success"
                  });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });

        mcommerce_modal(false);
    });
});

