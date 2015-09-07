<?php

/**
 *
 */
function tvds_work_display(){
    ?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
        <h2>Rigid Work Options</h2>

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php settings_errors(); ?>

        <!-- create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <!-- this are the display fields -->
            <?php settings_fields('tvds_theme_work_options'); ?>
            <?php do_settings_sections('tvds_theme_work_options'); ?>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

/*
 * WORK OPTIONS
 */
/**
 *
 */
function tvds_init_work_options(){
    if(false == get_option('tvds_theme_work_options')){
        // If the pricing options don't exist, create them.
        add_option('tvds_theme_work_options');
    }

    // THE SECTION
    add_settings_section(
        'work_settings_section',        // ID used to identify this section and with which to register options
        'Work Options',                 // Title to be displayed on the administration page
        'tvds_work_settings_cb',        // Callback used to render the description of the section
        'tvds_theme_work_options'       // Page on which to add this section of options
    );

    // THE DESCRIPTION CALLBACK
    function tvds_work_settings_cb(){
        echo '<p>Give all the content for works</p>';
    }

    // THE SETTINGS FIELDS
    add_settings_field(
        'work_labels',                  // ID used to identify this section and with which to register options
        'Work Labels',                  // The label to the left of the option interface element
        'tvds_add_labels_cb',           // The name of the function responsible for rendering the option interface
        'tvds_theme_work_options',      // The page on which this option will be displayed
        'work_settings_section'         // the name of the section to which this field belongs
    );

    // REGISTER THE SETTINGS
    register_setting('tvds_theme_work_options', 'tvds_theme_work_options');
}
add_action('admin_init', 'tvds_init_work_options');

// THE FIELDS CALLBACK
/**
 * Add the labels you want to select in the work post
 */
function tvds_add_labels_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_work_options');
    $default_labels = $options['default_labels'];

    $i = 0;
    ?>

    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody id="labels-can-add">
        <tr>
            <td>Fill in all the labels that can be chosen to be displayed in the projects</td>
        </tr>
        <?php
        foreach($default_labels as $label ){

            ?>
            <tr class="form-field">
                <td>
                    <input type="text" name="tvds_theme_work_options[default_labels][<?php echo $i; ?>][name]" value="<?php echo $label['name']; ?>" placeholder="Label name"><br>
                    <input type="text" name="tvds_theme_work_options[default_labels][<?php echo $i; ?>][icon]" value="<?php echo $label['icon']; ?>" placeholder="Icon name"><br>
                </td>
                <td>
                    <input type="button" class="remove-label button button-cancel" value="Remove Label">
                </td>
            </tr>
            <?php
            $i ++;
        }
        ?>
        </tbody>
    </table>
    <input style="float: left; margin-left: 10px;" id="add-labels" class="button button-primary" type="button" value="Add Labels"><br>
    <?php
}