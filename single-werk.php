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

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <?php
                    $labels = get_post_meta($post->ID, "_labels", true);
                    //            print_r($labels);

                    if(!empty($labels)){
                        foreach($labels as $label){
                            ?>
                            <div class="col-md-3 work-project-label">
                                <i class="<?php echo $label['icon'] ?>"></i>
                                <span><?php echo $label['name']; ?></span>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>



    </div>
<?php endwhile; ?>

<?php get_footer(); ?>

