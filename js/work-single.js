/**
 * Created by Tim on 9/8/2015.
 */
jQuery(document).ready(function(){
    $ = jQuery;

    $('.footer-work-projects-single').find('a').hover(function(){
        $(this).css('color', '#fff');
        $(this).find('.col-md-2').css('background-color', '#337ab7');
    }, function(){
        $(this).find('.col-md-2').css('background-color', '#373737');
    });
});