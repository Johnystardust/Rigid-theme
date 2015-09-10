<?php
/**
 * The template for the single work posts
 */
?>

<?php get_header();

global $post;

$work_options = get_option('tvds_theme_work_options');
if($work_options['show_work_header']){
    ?>
    <div class="container-fluid intro-work-project-single" style="background-image: url('<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_header_img', true)); ?>');">
        <div class="container intro-work-project-header">
            <div class="row text-center">
                <div class="col-md-3">
                    <h3>Opdrachtgever</h3>
                    <?php echo get_post_meta($post->ID, '_client_link', true); ?>
                </div>
                <div class="col-md-6">
                    <h1 class="no-margin" style="font-size: 3em"><?php the_title(); ?></h1>
                </div>
                <div class="col-md-3">
                    <h3>Bekijk het resultaat</h3>
                    <a id="header-link" target="_blank" href="<?php echo get_post_meta($post->ID, '_header_link', true); ?>"><?php echo get_post_meta($post->ID, '_header_link', true); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="container-fluid work-project-single no-padding">
        <div class="row">
            <div class="big-image col-md-8 col-md-offset-2 text-center">
                <img src="<?php echo wp_get_attachment_url(get_post_meta($post->ID, '_big_img', true)); ?>" width="100%"/>
            </div>
        </div>

        <div class="container work-single-content-wrapper">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid footer-work-projects-single no-padding">
        <div class="row">
            <?php
            $next_post              = get_next_post();
            $next_permalink         = get_permalink($next_post->ID);

            $prev_post              = get_previous_post();
            $prev_permalink         = get_permalink($prev_post->ID);

            $previous_adjacent_post = get_adjacent_post(true, '', true);
            $next_adjacent_post     = get_adjacent_post(true, '', false);

            if($previous_adjacent_post){
                echo '<a href="'.$prev_permalink.'"><div class="col-md-2"><span><i class="icon-left-open"></i> Previous Post</span></div></a>';
            } else {
                echo '<div class="col-md-2 not-clickable"><span><i class="icon-left-open"></i> Previous Post</span></div>';
            }
            ?>

            <a href="#">
                <div class="col-md-2 border">
                    <span><i class="icon-facebook-squared"></i> Delen</span>
                </div>
            </a>

            <div class="col-md-4">
                <span>Copyright © Rigid Webdesign 2015</span>
            </div>

            <a href="<?php echo get_page_link(13); ?>">
                <div class="col-md-2 border">
                    <span>Overzicht <i class="icon-th"></i></span>
                </div>
            </a>

            <?php
            if($next_adjacent_post){
                echo '<a href="'.$next_permalink.'"><div class="col-md-2"><span><i class="icon-right-open"></i> Vorige project</span></div></a>';
            } else {
                echo '<div class="col-md-2 not-clickable"><span>Volgende project <i class="icon-right-open"></i></span></div>';
            }
            ?>
        </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>

