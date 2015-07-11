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
    <div class="container-fluid intro-work-project-single" style="background-image: url('<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_header_img', true)); ?>');">
        <div class="container intro-work-project-header">
            <div class="row text-center">
                <div class="col-md-3">
                    <h3>Category</h3>
                    <?php the_category(); ?>
                </div>
                <div class="col-md-6">
                    <h1 class="no-margin" style="font-size: 3em"><?php the_title(); ?></h1>
                </div>
                <div class="col-md-3">
                    <h3>Bekijk het resultaat</h3>
                    <a id="header-link" href="<?php echo get_post_meta($post->ID, '_header_link', true); ?>"><?php echo get_post_meta($post->ID, '_header_link', true); ?></a>
                </div>
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

