<?php
/*
Template Name: Pricing Template
*/

get_header(); ?>

<div class="container-fluid pricing-template no-padding">
    <?php
    $args = array( 'post_type' => 'pricing');
    $the_query = new WP_Query($args);

    while($the_query->have_posts() ) : $the_query->the_post(); ?>

        <div class="row">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <a href="<?php echo get_permalink() ?>">bekijk meer</a>
        </div>

    <?php endwhile; wp_reset_postdata(); ?>
</div>


<?php get_footer(); ?>