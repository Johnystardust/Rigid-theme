<?php
/**
 * The template for the single work posts
 */
?>

<?php get_header(); ?>

<?php
global $post;

$work_options = get_option('tvds_theme_work_options');
if($work_options['show_work_header']){
    ?>
    <div class="container-fluid intro-work-project-single">
        <img src="<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_header_img', true)); ?>" width="100%"/>
        <div class="container">
            <div class="row text-center">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
<?php
}
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="container-fluid work-project-single">
        <div class="row">
            <div class="big-image col-md-8 col-md-offset-2 text-center">
                <img src="<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_big_img', true)); ?>" width="100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php the_content(); ?>
            </div>
        </div>

    </div>
<?php endwhile; ?>

<?php get_footer(); ?>

