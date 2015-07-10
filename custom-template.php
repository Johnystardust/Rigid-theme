<?php
/*
Template Name: Work Template
*/

get_header(); ?>

<?php
    global $post;

    $work_options = get_option('tvds_theme_work_options');
    if($work_options['show_work_header']){
        ?>
        <div class="container-fluid intro-work">
            <div class="container">
                <div class="row text-center">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <?php
    }
?>

<div class="container-fluid projects-work">
    <?php
    $i = 1;
    $class = '';
    $args = array( 'post_type' => 'work', 'posts_per_page' => 10 );
    $the_query = new WP_Query($args);
    while($the_query->have_posts() ) : $the_query->the_post();
    ?>
    <?php $i%2==0 ? $class = 'even' : $class = 'odd' ?>

    <div class="row" id="<?php echo 'row'.$i; ?>">
        <div class="col-md-7 image-work animated <?php if($class == 'odd'){echo 'col-md-push-5 bounceInRight';}else{echo 'bounceInLeft';} ?> text-center">
            <img src="<?php echo get_stylesheet_directory_uri().'/images/Responsive-show.png' ?>" width="100%"/>
        </div>

        <div class="col-md-4 info-work animated fadeInUp <?php if($class == 'odd'){echo 'col-md-pull-7';}else{echo 'col-md-offset-1';} ?>">
            <!-- title -->
            <h3 class="no-margin"><?php the_title(); ?></h3>

            <!-- labels -->
            <?php
                $labels = get_post_meta($post->ID, "_labels", true);
                print_r($labels);
                if(!empty($labels)){
                    echo '<br>';
                    foreach($labels as $label){
                        echo '<span class="label label-primary">'.$label.'</span>';
                    }
                }
            ?>

            <!-- content -->
            <div class="text-work">
                <p><?php echo wp_trim_words( get_the_content(), 75);  ?></p>
            </div>
            <!-- permalink -->
            <a class="btn btn-primary" href="<?php the_permalink(); ?>">Bekijk het project</a>
        </div>
    </div>
    <?php $i++; ?>
    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
