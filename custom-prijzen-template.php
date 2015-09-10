<?php
/*
Template Name: Prijzen Template
*/

get_header(); ?>
<div class="container-fluid pricing-template-header">
    <h1 class="no-margin"><?php the_title(); ?></h1>
    <div class="container intro-pricing">
        <div class="col-md-8 col-md-offset-2">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<div class="container-fluid pricing-template no-padding">
    <?php
    $args = array( 'post_type' => 'prijzen', 'order' => 'ASC' );
    $the_query = new WP_Query($args);

    // Get the services from the pricing options
    $options = get_option('tvds_theme_pricing_options');
    $services = $options['pricing'];
    $filtered = array_filter($services);

    while($the_query->have_posts() ) : $the_query->the_post();
        // Get the checked options
        $checked = get_post_meta($post->ID, '_pricing_check', true);
        ?>

        <div class="row <?php echo strtolower(get_the_title());; ?>">
            <div class="container">
                <div class="col-md-8 col-md-offset-2">
                    <h1><?php the_title(); ?></h1>

                    <?php the_content(); ?>
                </div>

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
                    <div class="price-amount">
                        <h2>Prijs € <?php echo get_post_meta($post->ID, '_pricing_price', true); ?></h2>
                    </div>
                    <a href="<?php echo the_permalink(); ?>" class="btn btn-primary buy">Bekijk details</a>
                </div>

            </div>
        </div>

    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php get_template_part( 'partials/quote' ); ?>

<?php get_footer(); ?>