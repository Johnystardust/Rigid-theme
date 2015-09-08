jQuery(document).ready(function(){
    $ = jQuery;

    $(".work-thumb-overlay").hide();

    // Work hover
    $(".project").hover(function(){
        $(this).find(".work-thumb-overlay").stop().fadeIn();
    }, function(){
        $(this).find(".work-thumb-overlay").stop().fadeOut();
    });
});