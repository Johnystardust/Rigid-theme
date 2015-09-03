<div id="works" class="works container-fluid">
    <div class="container">
        <h1 class="text-center">Recent Werk</h1>
        <br>
        <p class="text-center">
            Neem een kijkje in tussen de gemaakte websites en zie de mogelijkheden, heeft u vragen of opmerkingen dan hoor ik deze graag van u.
        </p>
        <br>

        <?php
        $i = 0;
        $args = array( 'post_type' => 'work', 'posts_per_page' => 4 );
        $the_query = new WP_Query($args);
        while($the_query->have_posts() ) : $the_query->the_post();

            $i < 4 ? $class= 'show-work' : $class = 'hide';

            if($i%4==0){ // place opening div if counter is multiple of 4
                echo '<div class="row no-margin">';
            }
            ?>
            <a id="work-link" class="work-link" href="<?php echo get_permalink() ?>">
                <div class="col-md-3 work animated fadeInUp <?php echo $class?>" <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <div class="work-img">
                        <div class="overlay">
                            <i class="icon-link"></i>
                        </div>
                        <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        }
                        ?>
                    </div>
                    <div class="details">
                        <h3><?php echo the_title(); ?></h3>
                        <span>
                            <?php
                                the_category();
                            ?>
                        </span>
                    </div>
                </div>
            </a>
            <?php
            $i ++;
            // place closing div if counter is multiple of 4
            if($i%4==0){
                echo '</div>';
            }
            ?>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php
        if($i%3!=0){
            echo '</div>';
        }
        if($i >= 4){
            ?>
            <div class="more-work text-center">
                <a class="btn btn-primary" href="<?php echo get_page_link(6)?>">Bekijk meer...</a>
            </div>
            <?php
        }
        ?>
    </div>
</div>