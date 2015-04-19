<div class="intro container">
    <div class="introduction">
        <?php
        $the_query = new WP_Query('category_name=Intro');
        while($the_query->have_posts()) : $the_query->the_post();
        ?>
            <h1 class="text-center"><?php echo the_title(); ?></h1><br>
            <?php echo the_content(); ?>
        <?php
        endwhile;
        ?>
    </div>
</div>