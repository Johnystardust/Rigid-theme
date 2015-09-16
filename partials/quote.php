<script type="text/javascript">
    jQuery(document).ready(function(){
        $ = jQuery;

        // The Vars
        var windowWidth = $(window).width();

        // The Resize Function
        $(window).resize(function(){
            windowWidth = $(window).width();                    // Sets The Var Again For The Quote Timer Animation
        });

        // Quotes
        function quotes_handler(){
            var rand;                               // Random Quote Number
            var timer;                              // The Timer Var
            var quotes = [                          // Quotes Array
                '<span>“What separates design from art</span><span> is that <strong>design</strong> is meant to be <strong>functional</strong>.”</span>',
                '<span>“Intuitive <strong>design</strong> is how we give the user new superpowers.”</span>',
                '<span>“Websites <strong>promote</strong> you 24/7: No employee will do that.”</span>',
                '<span>“If you think math is hard try<strong> web design</strong>.”</span>',
                '<span>“A website without <strong>SEO</strong> is like a car with no gas.”</span>',
                '<span>“Great <strong>web design</strong> without functionality is like a sports car with no engine.”</span>',
                '<span>“Websites should look good from the <strong>inside</strong> and <strong>out</strong>.”</span>',
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
</script>


<?php
    if( is_home() ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-pricing-optimized.jpg') fixed center 70%";
    }
    if( is_page( 'Werk' ) ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-work-optimized.jpg') fixed center 90%";
    }
    if( is_page( 'Prijzen' ) ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-pricing-optimized.jpg') fixed center 70%";
    }
    if( is_page( 'Diensten' ) ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-work-optimized.jpg') fixed center 90%";
    }
    if( is_page( 'Contact' ) ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-work-optimized.jpg') fixed center 90%";
    }
    if( is_404() ){
        $background_image = "url('../wp-content/themes/rigid-webdesign/images/rigid-pricing-optimized.jpg') fixed center 70%";
    }
?>

<div class="container-fluid quote no-padding" style="background: <?php echo $background_image; ?>; background-size: cover">
    <div class="row">
        <div class="col-md-12 quote-wrapper text-center">
            <h2 class="new-quote"><span>“Every child is an <strong>artist</strong>.</span><span class="clearfix"></span><span>The challenge is to remain an <strong>artist</strong> after you grow up.”</span></h2>
        </div>
        <div style="position: absolute; width: 100%;">
            <a class="next-quote">
                <i class="icon-arrows-cw"></i>
            </a>
        </div>
    </div>
    <div class="time-wrapper">
        <div class="time"></div>
        <div class="time-background"></div>
    </div>
</div>