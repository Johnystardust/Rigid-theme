<?php

function tvds_pricing_display(){
    ?>
    <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
    <div class="wrap">
        <h2>Rigid Pricing Options</h2>

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php settings_errors(); ?>

        <!-- create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <!-- this are the pricing fields -->
            <?php settings_fields('tvds_theme_pricing_options'); ?>
            <?php do_settings_sections('tvds_theme_pricing_options'); ?>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

/*
 * PRICING OPTIONS
 */
function tvds_init_pricing_options(){
    if(false == get_option('tvds_theme_pricing_options')){
        // If the pricing options don't exist, create them.
        add_option('tvds_theme_pricing_options');
    }

    // THE SECTION
    add_settings_section(
        'pricing_settings_section',     // ID used to identify this section and with which to register options
        'Pricing Options',              // Title to be displayed on the administration page
        'tvds_pricing_settings_cb',     // Callback used to render the description of the section
        'tvds_theme_pricing_options'    // Page on which to add this section of options
    );

    // THE DESCRIPTION CALLBACK
    function tvds_pricing_settings_cb(){
        echo '<p>Give all the services that are in the pricing packages</p>';
    }

    // THE SETTINGS FIELDS
    add_settings_field(
        'show_pricing',                 // ID used to identify this section and with which to register options
        'Display pricing',              // The label to the left of the option interface element
        'tvds_toggle_pricing_cb',       // The name of the function responsible for rendering the option interface
        'tvds_theme_pricing_options',   // The page on which this option will be displayed
        'pricing_settings_section',     // the name of the section to which this field belongs
        array(                          // the array of arguments to pass to the callback. In this case, just a description
            'Activate this setting to display the pricing section.'
        )
    );

    add_settings_field(
        'pricing',                      // ID used to identify this section and with which to register options
        'Pricing',                      // The label to the left of the option interface element
        'tvds_add_pricing_cb',          // The name of the function responsible for rendering the option interface
        'tvds_theme_pricing_options',   // The page on which this option will be displayed
        'pricing_settings_section'      // the name of the section to which this field belongs
    );

    // REGISTER THE SETTINGS
    register_setting('tvds_theme_pricing_options', 'tvds_theme_pricing_options');
}
add_action('admin_init', 'tvds_init_pricing_options');

// THE FIELDS CALLBACKS
function tvds_toggle_pricing_cb($args){
    // First, we read the options collection
    $options = get_option('tvds_theme_pricing_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    // We also access the show_header element of the options collection in the call to the checked() helper function
    $html = '<input type="checkbox" id="show_pricing" name="tvds_theme_pricing_options[show_pricing]" value="1" '.checked(1, $options['show_pricing'], false).'>';

    // Here, we'll take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="show_pricing">'.$args[0].'</label>';

    echo $html;
}

function tvds_add_pricing_cb(){
    // First, we read the pricing options collection
    $options = get_option('tvds_theme_pricing_options');
    $services = $options['pricing'];
    if(is_array($services)){
        $filtered = array_filter($services);
    }

    $i = 0;
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody id="services-can-add">
        <tr>
            <td>Fill in all the services that need to be displayed in the pricing table</td>
        </tr>
        <?php
            if(is_array($filtered)){
                foreach($filtered as $service){
                    ?>
                    <tr class="form-field">
                        <td>
                            <input type="text" id="pricing" name="tvds_theme_pricing_options[pricing][<?php //echo $i ?>]" value="<?php echo $service ?>">
                        </td>
                        <td>
                            <input type="button" class="remove-service button button-cancel" value="Remove Service">
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr class="form-field">
                    <td>
                        <input type="text" id="pricing" name="tvds_theme_pricing_options[pricing][<?php //echo $i ?>]" value="<?php echo $service ?>">
                    </td>
                    <td>
                        <input type="button" class="remove-service button button-cancel" value="Remove Service">
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
    <input style="float: left; margin-left: 10px;" id="add-service" class="button button-primary" type="button" value="Add Service"><br>
    <?php
}