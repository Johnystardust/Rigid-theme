jQuery(document).ready(function(){
    $ = jQuery;

    // hide the elements
    $('.image-work').hide();
    $('.info-work').hide();

    // loops trough the rows and adds the way point
    $('.projects-work').find('.row').each(function(i){
        var element = $(this);
        var id = element.attr('id');

        var id = new Waypoint({
            element: document.getElementById(id),
            handler: function(){
                element.find('.image-work').fadeIn();
                element.find('.info-work').fadeIn();
            },
            offset: 450
        });
    });

});