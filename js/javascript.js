jQuery(document).ready(function(){
    $ = jQuery;
    
    $('body').addClass('loaded');

    // Hide
    $(".overlay").hide();
    $(".maps-close").hide();
    $(".go-up").hide();
    $(".work").hide();
    $(".more-work").hide();
    $(".more-pricing").hide();
    $(".service").hide();
    $(".pricing").find(".col-md-3").hide();

    // The Vars
    var windowHeight = $(window).height();

    // The Resize Function
    $(window).resize(function(){
        windowHeight = $(window).height();

        $('header').css('height', windowHeight);
    });

    $('header').css('height', windowHeight);

    // Work hover
    $(".work-img").hover(function(){
        $(this).find(".overlay").stop().fadeIn();
    }, function(){
        $(this).find(".overlay").stop().fadeOut();
    });

    // Services
    $('.service').find('a').click(function(){
        return false;
    });

    // Pricing
    $(".price").hover(function(){
        $(this).addClass("hover-price");
        $(this).parent().css("z-index", 10000)
    }, function(){
        $(this).removeClass("hover-price");
        $(this).parent().css("z-index", 0);
    });

    // Maps fold open
    $(".maps-fold").click(function(){
        if($(window).width() < 992){
            //$(".form-contact").animate({ left: -1500 });
            $(".form-info").animate({ left: 1500 });
            $(".maps-close").fadeIn();
            return false;
        } else {
            $(".form-contact").animate({ left: -1500 });
            $(".form-info").animate({ left: 1500 });
            $(".maps-close").fadeIn();
            return false;
        }
    });

    // Maps close
    $(".maps-close").click(function(){
        $(".maps-close").fadeOut();
        $(".form-contact").animate({ left: 0 });
        $(".form-info").animate({ left: 0 });
        return false;
    });

    // Vars
    var scrollTop     = $(window).scrollTop(),
        elementOffset = $(".intro").offset().top,
        distance      = (elementOffset - scrollTop);

    // Scroll down
    $(".scroll-down").find("a").click(function(){
        $("html, body").animate({ scrollTop: distance}, 600);
        return false;
    });
});