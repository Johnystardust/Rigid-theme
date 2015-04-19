<div id="services" class="services container">
    <h1 class="text-center">Wat kan ik voor u doen</h1>
    <?php
    $i = 0;
    $args = array('post_type' => 'service', 'order' => 'ASC');
    $the_query = new WP_Query($args);
    while($the_query->have_posts()) : $the_query->the_post();
        if($i%3==0){ // place opening div if counter is multiple of 4
            echo '<div class="row no-margin">';
        }
    ?>

        <div class="col-md-4 service animated fadeInUp">
            <div class="text-center">
                <a>
                    <i class="<?php echo get_post_meta($post->ID, '_icon', true); ?>"></i>
                    <h3><?php the_title(); ?></h3>
                    <div class="service-info"><span><?php echo get_the_content(); ?></span></div>
                </a>
            </div>
        </div>
    <?php
        $i ++;
        if($i%3==0){
            echo '</div>';
        }
    endwhile; wp_reset_postdata();
    if($i%3!=0){
        echo '</div>';
    }
    ?>
</div>

