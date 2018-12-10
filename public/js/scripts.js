
$(document).ready(function() {


    // FADE OUT DEL MENSAJE DE CONFIRMACION

    // if($('.message').is(':visible')){
    //     setTimeout(function(){
    //         $('.message').fadeOut("slow");
    //     }, 3000);
    // }

    function preventDoubleSubmission() {

        var last_clicked, time_since_clicked;

        jQuery(this).bind('submit', function(event) {

            if(last_clicked) {
                time_since_clicked = jQuery.now() - last_clicked;
            }

            last_clicked = jQuery.now();

            if(time_since_clicked < 2000) {
                // Blocking form submit because it was too soon after the last submit.
                event.preventDefault();
            }

            return true;
        });
    };

    $(':submit').click(preventDoubleSubmission());


});