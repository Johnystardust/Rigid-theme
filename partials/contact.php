<?php $display_option = get_option('tvds_theme_display_options'); ?>
<div class="contact container-fluid no-padding">
    <div class="row no-margin">
        <div class="col-md-6 form-contact">
            <form method="post" action="">
                <!-- Name -->
                <div class="form-group">
                    <div class="tag-line">
                        <label for="inputName"><span>Naam</span></label>
                    </div>
                    <input type="text" class="form-control name" id="inputName" placeholder="Enter name">
                </div>
                <!-- E-mail -->
                <div class="form-group">
                    <div class="tag-line">
                        <label for="inputEmail"><span>E-mail</span></label>
                    </div>
                    <input type="email" class="form-control email" id="inputEmail" placeholder="Enter e-mail">
                </div>
                <!-- Message -->
                <div class="form-group">
                    <div class="tag-line">
                        <label for="inputText"><span>Bericht</span></label>
                    </div>
                    <textarea type="text" class="form-control" id="inputText" placeholder="Enter message" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Versturen</button>
            </form>
        </div>
        <div class="col-md-6 no-padding form-info">
            <div class="overlay-maps text-center">
                <div class="row">
                    <h2 class="no-margin">Hoe kunt u mij bereiken</h2><br/>
                    <div class="contact-text">
                        <h4>Via mail</h4>
                        <a><span class="glyphicon glyphicon-envelope"></span> <?php echo $display_option['email'] ?></a><br/>
                        <h4>Zoek mij op</h4>
                        <span><?php echo $display_option['address'] ?></span><br>
                        <span><?php echo $display_option['postal'] ?></span><br>
                        <span class="icon"><a class="maps-fold"><i class="icon-search"></i></a></span><br/>
                        <h4>Bel mij</h4>
                        <a><i class="icon-mobile"></i><?php echo $display_option['phone'] ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- google maps -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var mapCanvas = document.getElementById('map-canvas');
                var myLatLng = new google.maps.LatLng(51.836440, 5.849507);
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

        <div class="maps">
            <span class="maps-close icon text-center"><a><i class="icon-cancel-circled"></i></a></span>
            <div id="map-canvas"></div>
        </div>
    </div>
</div>