<?php
/*
Template Name: Contact Template
*/

get_header(); ?>

<div class="container-fluid custom-page-header contact-template-header">
    <div class="container">
        <div class="row text-center template-header-title">
            <h1 class="no-margin"><?php the_title(); ?></h1>
        </div>
        <div class="row template-header-description">
            <div class="col-md-8 col-md-offset-2">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid contact-template">
    <div class="container form-container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <?php echo do_shortcode('[tvds_contact_form]'); ?>
            </div>
        </div>
    </div>


    <div class="row contact-template-maps">
        <!-- google maps -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var mapCanvas = document.getElementById('map-canvas');
                var myLatLng = new google.maps.LatLng(51.9794907, 5.9095527,17);
                var mapOptions = {
                    center: myLatLng,
                    zoom: 14,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI:false
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'Rigid Webdesign',
                    animation: google.maps.Animation.DROP
                });
                var contentString = '<div id="content">' +
                    '<div class="siteNotice">' +
                    '</div>Rigid Webdesign</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                google.maps.event.addListener(marker, 'click', function(){
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

        <div id="map-canvas" style="height: 300px;">

        </div>
    </div>
</div>

<?php get_template_part( 'partials/quote' ); ?>

<?php get_footer();