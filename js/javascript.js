jQuery(document).ready(function(){
    $ = jQuery;
    
    $('body').addClass('loaded');

    // Hide
    $(".overlay").hide();
    $(".maps-close").hide();
    $(".go-up").hide();
    $(".work").hide();
    $(".more").hide();
    $(".service").hide();
    $(".pricing").find(".col-md-3").hide();

    // The Vars
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();

    // The Resize Function
    $(window).resize(function(){
        windowWidth = $(window).width();                    // Sets The Var Again For The Quote Timer Animation
        windowHeight = $(window).height();                  // Sets The Var Again For The Wrapper Height


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
        distance      = (elementOffset - scrollTop - 20);

    // Scroll down
    $(".scroll-down").find("a").click(function(){
        $("html, body").animate({ scrollTop: distance}, 600);
        return false;
    });

    // Quotes
    function quotes_handler(){
        var rand;                               // Random Quote Number
        var timer;                              // The Timer Var
        var quotes = [                          // Quotes Array
            //'<span>“What separates design from art</span><span>is that <strong>design</strong> is meant to be <strong>functional</strong>.”</span>',
            //'<span>“Intuitive <strong>design</strong> is how we give the user new superpowers.”</span>',
            //'<span>“Websites <strong>promote</strong> you 24/7: No employee will do that.”</span>',
            //'<span>“If you think math is hard try <strong>web design</strong>.”</span>',
            //'<span>“A website without <strong>SEO</strong> is like a car with no gas.”</span>',
            //'<span>“Great <strong>web design</strong> without functionality is like a sports car with no engine.”</span>',
            //'<span>“Websites should look good from the <strong>inside</strong> and <strong>out</strong>.”</span>',
            '<span>“Every child is an <strong>artist</strong>.</span><span class="clearfix"></span><span>The challenge is to remain an <strong>artist</strong> after you grow up.”</span>'
        ];

        // The Click Function
        $('.next-quote').click(function(){
            $('.time').stop().animate({width:'0px'}, 0);                                // Set The Timer Back To 0
            rand = quotes[Math.floor(Math.random() * quotes.length)];                   // Get A New Random Quote

            $('.new-quote').fadeOut(300);                                               // Fade Out The Old Quote
            setTimeout(function(){$('.new-quote').html(rand);}, 300);                   // Insert The New Quote
            $('.new-quote').delay(300).fadeIn(300);                                     // Fade In The New Quote

            $('.time').stop().delay(300).animate({width:windowWidth+'px'}, 7000);       // Start The Animate On The Timer
            clearInterval(timer);                                                       // Clear the Interval
            timer = setInterval(serve_quote, 7000);
        });

        $('.time').stop().animate({width:windowWidth+'px'}, 7000);                      // Start The Animate On The Timer For The First Time
        // Automatic Play Function
        function serve_quote(){
            $('.time').stop().animate({width:'0px'}, 0);                                // Set The Timer Back To 0
            $('.time').stop().animate({width:windowWidth+'px'}, 7000);                  // Start The Animate On The Timer

            rand = quotes[Math.floor(Math.random() * quotes.length)];                   // Get A New Random Quote
            $('.new-quote').html(rand);                                                 // Insert The New Quote
        }

        timer = setInterval(serve_quote, 7000);                                         // Start The Interval
    }
    quotes_handler();
});