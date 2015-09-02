    <?php $display_option = get_option('tvds_theme_display_options'); ?>
    <footer>
        <div class="container-fluid">
            <div class="left">
                <ul class="contacts">
                    <li><p><?php echo $display_option['name'] ?></p></li>
                    <li><p><?php echo $display_option['address'] ?></p></li>
                    <li><p><?php echo $display_option['postal'] ?></p></li>
                    <li><a><i class="icon-post"></i><?php echo $display_option['email'] ?></a></li>
                </ul>
            </div>
            <div class="middle">
                <ul class="contacts">
                    <li><p><?php echo $display_option['kvk'] ?></p></li>
                    <li><p><?php echo $display_option['btw'] ?></p></li>
                    <li><p><?php echo $display_option['iban'] ?></p></li>
                    <li><a><i class="icon-mobile"></i><?php echo $display_option['phone'] ?></a></li>
                </ul>
            </div>
            <div class="right">
                <ul class="social">
                    <?php if(!empty($display_option['google'])){
                        ?>
                        <li><a href="<?php echo $display_option['google'] ?>" target="_blank"><i class="icon-gplus-circled"></i></a></li>
                        <?php
                    } ?>
                    <?php if(!empty($display_option['linkedin'])){
                        ?>
                        <li><a href="<?php echo $display_option['linkedin'] ?>" target="_blank"><i class="icon-linkedin-circled"></i></a></li>
                    <?php
                    } ?>
                    <?php if(!empty($display_option['facebook'])){
                        ?>
                        <li><a href="<?php echo $display_option['facebook'] ?>" target="_blank"><i class="icon-facebook-circled"></i></a></li>
                    <?php
                    } ?>
                    <?php if(!empty($display_option['twitter'])){
                        ?>
                        <li><a href="<?php echo $display_option['twitter'] ?>" target="_blank"><i class="icon-twitter-circled"></i></a></li>
                    <?php
                    } ?>




                </ul>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>