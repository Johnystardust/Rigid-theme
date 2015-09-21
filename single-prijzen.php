<?php
/**
 * The template for the single prijzen posts
 */

get_header();

global $post;
// Get the services from the pricing options
$options = get_option('tvds_theme_pricing_options');
$services = $options['pricing'];
$filtered = array_filter($services);

// Get the checked options
$checked = get_post_meta($post->ID, '_pricing_check', true);
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="container-fluid custom-page-header pricing-header-single">
        <div class="container">
            <div class="row text-center template-header-title">
                <h1><?php the_title(); ?></h1>
            </div>
            <div class="row template-header-description">
                <div class="col-md-8 col-md-offset-2">
                    <p><?php echo get_post_meta($post->ID, '_pricing_description', true); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pricing-single">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="services-list-horizontal row seven-cols no-margin">
                        <h2>Inhoud</h2>
                        <?php
                        foreach($filtered as $service){
                            if(in_array($service, $checked)){
                                ?>
                                <div class="col-md-1 service-list-horizontal include"><i class="icon-<?php echo strtolower($service); ?>"></i><p><?php echo $service ?></p></div>
                            <?php
                            } else {
                                ?>
                                <div class="col-md-1 service-list-horizontal exclude"><i class="icon-<?php echo strtolower($service); ?>"></i><p><?php echo $service ?></p></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <?php the_content(); ?>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <div class="price-amount">
                        <h2>Prijs € <?php echo get_post_meta($post->ID, '_pricing_price', true); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<?php get_template_part( 'partials/quote' ); ?>

<?php get_footer(); ?>