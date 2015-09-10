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

get_template_part( 'partials/slider' );

get_template_part( 'partials/introduction' );

get_template_part( 'partials/work' );

get_template_part( 'partials/services' );

get_template_part( 'partials/pricing' );

get_template_part( 'partials/contact' );

get_template_part( 'partials/quote' );

get_footer();
