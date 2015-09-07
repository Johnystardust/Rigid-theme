<?php
$options = get_option('tvds_theme_display_options');
?>

<div class="intro container-fluid">
    <div class="container">
        <div class="col-md-8 col-md-offset-2 introduction">
            <h1><?php echo $options['intro_title']; ?></h1>
            <p><?php echo $options['intro_text']; ?></p>
        </div>
    </div>
</div>