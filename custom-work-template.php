<?php
/*
Template Name: Work Template
*/

get_header(); ?>

<div class="container-fluid work-projects no-padding">
    <?php
    $args = array( 'post_type' => 'work' );
    $the_query = new WP_Query($args);

    while($the_query->have_posts() ) : $the_query->the_post();?>

        <a href="<?php echo get_permalink() ?>">
            <div class="col-md-3 project no-padding">

                <!-- post thumb-->
                <div class="work-thumb">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }
                ?>
                </div>

                <!-- thumb overlay -->
                <div class="work-thumb-overlay">
                    <div style="display: table; height: 100%; width: 100%">
                    <div style="display: table-cell; vertical-align: middle">

                        <h3><?php echo the_title(); ?></h3>
                        <hr/>
                        <?php
                        $category = get_the_category();
                        ?>
                        <h4><?php echo $category[0]->cat_name; ?></h4>

                    </div>
                    </div>

                </div>
            </div>
        </a>

    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
