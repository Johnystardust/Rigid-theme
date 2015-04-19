<?php
/**
 * The main template file
 *
 * @package 	WordPress
 * @subpackage 	Rigid
 *
 */
?>
<?php
get_header();

$display_options = get_option('tvds_theme_display_options');
$pricing_options = get_option('tvds_theme_pricing_options');

if($display_options['show_header']){
    include "partials/slider.php";
}

include "partials/introduction.php";

if($display_options['show_work']){
    include "partials/work.php";
}

include "partials/services.php";

if($pricing_options['show_pricing']){
    include "partials/pricing.php";
}

include "partials/contact.php";

if($display_options['show_quotes']){
    include "partials/quote.php";
}

get_footer();
