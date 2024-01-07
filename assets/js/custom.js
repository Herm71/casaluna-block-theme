jQuery(document).ready(function($) {

$(".trip-download-div").has("#wptravel-trip-downloads-block").css("display", "block");

$(".trip-sale-div").has("#wptravel-block-trip-sale").css("display", "block");

$(".trip-facts-div").has("#wptravel-block-trip-fact").css("display", "block");

$("<div id='close-enquiry'><i class='fa fa-times' aria-hidden='true'></i></div>").insertBefore('.wp-travel-enquiries-form-wrapper');

$( '#close-enquiry' ).click( function(){
    $( '#wptravel-block-trip-enquiry' ).css( 'display', 'none' );
} );

$( '#trip-enquiry' ).click( function(){
    $( '#wptravel-block-trip-enquiry' ).css( 'display', 'block' );
} );

$( '#trip-booking' ).click( function(){
     $(".resp-tab-content").css( "display", "none" );
    $( "#booking" ).closest(".resp-tab-content").css( "display", "block" );
} );


setTimeout(() => {
   $( "#theme-loader" ).css( "display", "none" );
}, 1000);
    
/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});