<?php

add_action('admin_init', 'add_pricing_custom_scripts');
function add_pricing_custom_scripts(){
    wp_register_script('pricingjs' ,get_stylesheet_directory_uri().'/js/pricingjs.js', false);
    wp_enqueue_script('pricingjs');
}

// The menu page options
function tvds_create_menu_page(){
    add_theme_page(
        'Theme options',       // The title to be displayed in the browser window for this page.
        'Theme options',       // The text to be displayed for this menu item
        'administrator',       // Which type of users can see this menu item
        'theme_options',       // The unique ID - that is, the slug - for this menu item
        'tvds_theme_display'   // The name of the function to call when rendering the menu for this page
    );

    add_theme_page(
        'Work options',        // The title to be displayed in the browser window for this page.
        'Work options',        // The text to be displayed for this menu item
        'administrator',       // Which type of users can see this menu item
        'work_options',        // The unique ID - that is, the slug - for this menu item
        'tvds_work_display'    // The name of the function to call when rendering the menu for this page
    );

    add_theme_page(
        'Pricing options',     // The title to be displayed in the browser window for this page.
        'Pricing options',     // The text to be displayed for this menu item
        'administrator',       // Which type of users can see this menu item
        'pricing_options',     // The unique ID - that is, the slug - for this menu item
        'tvds_pricing_display' // The name of the function to call when rendering the menu for this page
    );
}
add_action('admin_menu', 'tvds_create_menu_page');

// Renders the main theme options page
include_once('theme-display.php');

// Renders the work options page
include_once('theme-work.php');

// Renders the pricing options page
include_once('theme-pricing.php');


