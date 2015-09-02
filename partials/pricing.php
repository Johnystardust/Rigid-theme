<div id="pricing" class="pricing container-fluid">
    <div class="container">
        <div class="row">
            <?php
            global $post;

            // Get the services from the pricing options
            $options = get_option('tvds_theme_pricing_options');
            $services = $options['pricing'];
            $filtered = array_filter($services);

            // Query Arguments
            $args = array(
                'post_type' => 'pricing',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DEC'
            );



            $the_query = new WP_Query($args);
            while($the_query->have_posts()) : $the_query->the_post();
                // Get the checked options
                $checked = get_post_meta($post->ID, '_pricing_check', true);
            ?>
                <div class="col-md-3 text-center animated zoomIn">
                    <div class="price <?php echo strtolower(get_the_title());; ?>">
                        <div class="price-title text-center">
                            <h1><?php the_title(); ?></h1><hr>
                        </div>
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
                        <div class="price-amount">
                            <h2>€ <?php echo get_post_meta($post->ID, '_pricing_price', true); ?>,-</h2>
                        </div>
                        <a href="<?php echo the_permalink(); ?>" class="btn btn-primary buy">Bekijk details</a>
                    </div>
                </div>
            <?php
            endwhile; wp_reset_postdata();
            ?>
        </div>
    </div>
</div>