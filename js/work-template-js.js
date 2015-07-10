jQuery(document).ready(function(){
    $(".work-thumb-overlay").hide();

    // Work hover
    $(".project").hover(function(){
        $(this).find(".work-thumb-overlay").stop().fadeIn();
    }, function(){
        $(this).find(".work-thumb-overlay").stop().fadeOut();
    });
});