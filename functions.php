<?php

// Enqueue the scripts and styles
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');
function add_my_custom_scripts(){
    // de-register stock jquery
    wp_deregister_script( 'jquery' );

    // register for all
    wp_register_script('my_jquery' ,get_stylesheet_directory_uri().'/includes/jquery/jquery.1.11.1.min.js', false);
    wp_register_script('my_bootstrap_js' ,get_stylesheet_directory_uri().'/includes/bootstrap/js/bootstrap.min.js', false);
    wp_register_script('my_way_points' ,get_stylesheet_directory_uri().'/includes/waypoints/lib/noframework.waypoints.min.js', false);
    wp_register_script('my_scroll', get_stylesheet_directory_uri().'/js/scroll.js', false);

    // register for home
    wp_register_script('my_javascript' ,get_stylesheet_directory_uri().'/js/javascript.js', false);
    wp_register_script('my_waypoints' ,get_stylesheet_directory_uri().'/js/waypoints.js', false);

    // register for work
    wp_register_script('my_work_template' ,get_stylesheet_directory_uri().'/js/work-template.js', false);

    // enqueue
    wp_enqueue_script('my_jquery');
    wp_enqueue_script('my_way_points');
    wp_enqueue_script('my_bootstrap_js');
    wp_enqueue_script('my_scroll');

    // enqueue if home
    if(is_home()){
        wp_enqueue_script('my_javascript');
        wp_enqueue_script('my_waypoints');
    }
    // enqueue if work
    if(is_page('Werk')){
        wp_enqueue_script('my_work_template');
    }
}

add_action('wp_enqueue_scripts', 'add_my_custom_styles');
function add_my_custom_styles(){
    //register
    wp_register_style('my_stylesheet', get_stylesheet_directory_uri().'/css/style.css');
    wp_register_style('my_style_map', get_stylesheet_directory_uri().'/css/style.css.map');
    wp_register_style('my_bootstrap', get_stylesheet_directory_uri().'/includes/bootstrap/css/bootstrap.min.css');
    wp_register_style('my_fontello', get_stylesheet_directory_uri().'/includes/fontello/fontello-embedded.css');
    wp_register_style('my_animate', get_stylesheet_directory_uri().'/includes/animate/animate.min.css');

    //enqueue
    wp_enqueue_style('my_stylesheet');
    wp_enqueue_style('my_style_map');
    wp_enqueue_style('my_bootstrap');
    wp_enqueue_style('my_fontello');
    wp_enqueue_style('my_animate');
}

/*
 * SETTINGS PAGE
 *
 * This is where the settings page is added
 * Look in 'theme-files/options' for more detail
 */
if(is_admin()){
    include_once('theme-files/options/theme-options.php');
}

/*
 * WORK
 *
 * This is the functionality for the work custom post type
 * Look in 'theme-files/work' for more detail
 */
include_once('theme-files/work/work.php');

/*
 * SERVICES
 *
 * This is the functionality for the services custom post type
 * Look in 'theme-files/services' for more detail
 */
include_once('theme-files/services/services.php');

/*
 * PRICING TABLE
 *
 * This is the functionality for the pricing table
 * Look in 'theme-files/pricing' for more detail
 */
include_once('theme-files/pricing/pricing.php');
