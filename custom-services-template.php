<?php
/*
Template Name: Services Template
*/

get_header();

global $post;
?>

<div class="container-fluid services-template no-padding">
    <div class="container">
    <?php
    $args = array( 'post_type' => 'service');
    $the_query = new WP_Query($args);

    while($the_query->have_posts() ) : $the_query->the_post(); ?>

        <div class="row">
            <div class="col-md-1 col-md-offset-2">
                <i class="<?php echo get_post_meta($post->ID, '_icon', true); ?>"></i>
            </div>
            <div class="col-md-7">
                <h2 class="no-margin"><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>

    <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>

<?php
get_footer();