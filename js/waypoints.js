jQuery(document).ready(function(){
    $ = jQuery;

    // WayPoints
    var beginWaypoint = new Waypoint({
        element: document.getElementById("html"),
        handler: function(){
            setTimeout(function(){
                $('.welcome1').addClass('active');
            }, 300);
            setTimeout(function(){
                $('.welcome2').addClass('active');
            }, 600);
            setTimeout(function(){
                $('.welcome1').removeClass('active');
            }, 1600);
            setTimeout(function(){
                $('.welcome2').removeClass('active');
            }, 1900);
            setTimeout(function(){
                $('.span-welcome').fadeOut();
            }, 2100);
            setTimeout(function(){
                $('.part1').addClass('active');
            }, 2400);
            setTimeout(function(){
                $('.part2').addClass('active');
            }, 2700);
            setTimeout(function(){
                $('.part3').addClass('active');
            }, 3000);
            setTimeout(function(){
                $('.part4').addClass('active');
            }, 3300);
            setTimeout(function(){
                $('.part5').addClass('active');
            }, 3600);
            setTimeout(function(){
                $('.scroll-down').addClass('active');
            }, 3900);
        }
    });

    var workWaypoint = new Waypoint({
        element: document.getElementById("works"),
        handler: function() {
            $(".show-work").each(function(index) {
                $(this).delay(index * 250).fadeIn();
            });
            $(".more").delay(4 * 250).fadeIn();
        },
        offset: 350
    });

    var servicesWaypoint = new Waypoint({
        element: document.getElementById("services"),
        handler: function() {
            $(".service").each(function(index) {
                $(this).delay(index * 250).fadeIn();
            });

        },
        offset: 250
    });

    var pricingWaypoint = new Waypoint({
        element: document.getElementById("pricing"),
        handler: function() {
            $('#pricing').find(".col-md-3").each(function(index) {
                $(this).delay(index * 250).fadeIn();
            });
        },
        offset: 250
    });
});