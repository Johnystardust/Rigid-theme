<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <meta charset="utf-8">
    <!-- Set the viewport so this responsive site displays correctly on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tim van der Slik">
    <title>Rigid - Webdesign</title>

    <!-- google -->
    <!-- google analytics -->
    <meta name="google-site-verification" content="-pv11sqnPXQR0IXB5VCdJljytXtf1kLN4IGqoBCeHc8" />
    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400' rel='stylesheet' type='text/css'>

    <!-- wp enqueue scripts and styles -->
    <?php wp_head(); ?>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>" class="navbar-brand pull-left">Rigid Webdesign</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="<?php echo site_url(); ?>">Home</a></li>
                    <li><a href="<?php echo get_page_link(6); ?>">Work</a></li>
                    <li><a href="<?php echo get_page_link(110); ?>">Diensten</a></li>
                    <li><a href="<?php echo get_page_link(76); ?>">Offerte</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- go up -->
    <a class="go-up text-center">
        <i class="icon-up-open"></i>
    </a>

    <!-- Here comes the index  -->