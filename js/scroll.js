jQuery(document).ready(function(){
    $ = jQuery;

    $(window).load(function () {
        alert('load-complete');
        if($(window).scrollTop() > 100){
            $('.go-up').fadeIn();
        }
    });

    // Scroll to top fadeIn/fadeOut
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.go-up').fadeIn();
        } else {
            $('.go-up').fadeOut();
        }
    });

    // Scroll to top
    $('.go-up').click(function(){
        $("html, body").animate({ scrollTop: 0 },600);
        return false
    });
});