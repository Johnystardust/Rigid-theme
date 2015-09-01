<?php
/*
Template Name: Services Template
*/

get_header(); ?>

<div class="container-fluid services-template no-padding">
    <?php
    $args = array( 'post_type' => 'service');
    $the_query = new WP_Query($args);

    while($the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="row">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <i class="<?php echo get_post_meta($post->ID, '_icon', true); ?>"></i>
        </div>
    <?php endwhile; wp_reset_postdata();

    ?>
</div>

<?php
get_footer();