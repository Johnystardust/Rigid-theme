<?php
/**
 * The template for the single work posts
 */

get_header();

global $post; ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php
    // Get the services from the pricing options
    $options = get_option('tvds_theme_pricing_options');
    $services = $options['pricing'];
    var_dump($services);
    $filtered = array_filter($services);

    // Get the checked options
    $checked = get_post_meta($post->ID, '_pricing_check', true);
    ?>

    <div class="container-fluid pricing-single">

        <h3><?php echo the_title(); ?></h3>
        <?php echo the_content(); ?>

        <div class="services-list">
            <?php
            foreach($filtered as $service){
                if(in_array($service, $checked)){
                    echo '<div class="service-list include"><i class="icon-ok"></i><span>'.$service.'</span></div>';
                } else {
                    echo '<div class="service-list exclude"><i class="icon-cancel"></i><span>'.$service.'</span></div>';
                }
            }
            ?>
        </div>

        <h2>€<?php echo get_post_meta($post->ID, '_pricing_price', true); ?>,-</h2>


    </div>

<?php endwhile;
get_footer();

?>