<div class="intro container-fluid">
    <div class="container">
        <div class="col-md-8 col-md-offset-2 introduction">
            <?php
            $the_query = new WP_Query('category_name=Intro');
            while($the_query->have_posts()) : $the_query->the_post();
                ?>
                <h1 class="text-center no-margin"><?php echo the_title(); ?></h1><br>
                <?php echo the_content(); ?>
            <?php
            endwhile;
            ?>
        </div>
    </div>
</div>