<?php

function tvds_theme_display(){
    ?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
        <h2>Rigid Theme Options</h2>

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php settings_errors(); ?>

        <!-- create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <!-- this are the display fields -->
            <?php settings_fields('tvds_theme_display_options'); ?>
            <?php do_settings_sections('tvds_theme_display_options'); ?>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Setting registration
function tvds_init_theme_options(){
    // If option doesn't exist create it
    if(false == get_option('tvds_theme_display_options')){
        add_option('tvds_theme_display_options');
    }

    // INTRO GENERAL
    add_settings_section(
        'intro_settings_section',       // ID used to identify this section and with which to register options
        'Intro Options',                // Title to be displayed on the administration page
        'tvds_intro_settings_cb',       // Callback used to render the description of the section
        'tvds_theme_display_options'    // Page on which to add this section of options
    );

    // INTRO TITLE
    add_settings_field(
        'intro_title',                  // ID used to identify this section and with which to register options
        'Intro Title',                  // The label to the left of the option interface element
        'tvds_intro_title_options_cb',  // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'intro_settings_section'        // The name of the section to which this field belongs
    );

    // INTRO TEXT
    add_settings_field(
        'intro_text',                   // ID used to identify this section and with which to register options
        'Intro Text',                   // The label to the left of the option interface element
        'tvds_intro_text_options_cb',   // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'intro_settings_section'        // The name of the section to which this field belongs
    );

    // FOOTER SECTION
    add_settings_section(
        'footer_settings_section',      // ID used to identify this section and with which to register options
        'Footer Options',               // Title to be displayed on the administration page
        'tvds_footer_settings_cb',      // Callback used to render the description of the section
        'tvds_theme_display_options'    // Page on which to add this section of options
    );

    // NAME
    add_settings_field(
        'name',                         // ID used to identify this section and with which to register options
        'Name',                         // The label to the left of the option interface element
        'tvds_name_options_cb',         // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // ADDRESS
    add_settings_field(
        'address',                      // ID used to identify this section and with which to register options
        'Address',                      // The label to the left of the option interface element
        'tvds_address_options_cb',      // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // POSTAL CODE
    add_settings_field(
        'postal',                       // ID used to identify this section and with which to register options
        'Postal code',                  // The label to the left of the option interface element
        'tvds_postal_options_cb',       // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // EMAIL
    add_settings_field(
        'email',                        // ID used to identify this section and with which to register options
        'Email',                        // The label to the left of the option interface element
        'tvds_email_options_cb',        // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // KVK NUMBER
    add_settings_field(
        'kvk',                          // ID used to identify this section and with which to register options
        'Kvk number',                   // The label to the left of the option interface element
        'tvds_kvk_options_cb',          // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // BTW NUMBER
    add_settings_field(
        'btw',                          // ID used to identify this section and with which to register options
        'Btw number',                   // The label to the left of the option interface element
        'tvds_btw_options_cb',          // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // IBAN NUMBER
    add_settings_field(
        'iban',                         // ID used to identify this section and with which to register options
        'Iban number',                  // The label to the left of the option interface element
        'tvds_iban_options_cb',         // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // PHONE NUMBER
    add_settings_field(
        'phone',                        // ID used to identify this section and with which to register options
        'Phone number',                 // The label to the left of the option interface element
        'tvds_phone_options_cb',        // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // TWITTER
    add_settings_field(
        'twitter',                      // ID used to identify this section and with which to register options
        'Twitter URL',                  // The label to the left of the option interface element
        'tvds_twitter_options_cb',      // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // GOOGLE PLUS
    add_settings_field(
        'google',                       // ID used to identify this section and with which to register options
        'Google + URL',                 // The label to the left of the option interface element
        'tvds_google_options_cb',       // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // FACEBOOK
    add_settings_field(
        'facebook',                     // ID used to identify this section and with which to register options
        'Facebook URL',                 // The label to the left of the option interface element
        'tvds_facebook_options_cb',     // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // LINKED IN
    add_settings_field(
        'linkedin',                     // ID used to identify this section and with which to register options
        'LinkedIn URL',                 // The label to the left of the option interface element
        'tvds_linkedin_options_cb',     // The name of the function responsible for rendering the option interface
        'tvds_theme_display_options',   // The page on which this option will be displayed
        'footer_settings_section'       // The name of the section to which this field belongs
    );

    // Finally, we register the fields with WordPress
    register_setting('tvds_theme_display_options', 'tvds_theme_display_options');
}
add_action('admin_init', 'tvds_init_theme_options');

// Description callbacks
function tvds_intro_settings_cb(){
    echo '<p>Fill in the intro text.</p>';
}

function tvds_intro_title_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    $html = '<input type="text" id="intro-title" name="tvds_theme_display_options[intro_title]" value="'.$options['intro_title'].'" >';

    echo $html;
}

function tvds_intro_text_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<textarea id="intro-text" name="tvds_theme_display_options[intro_text]" cols="70" rows="7">'.$options['intro_text'].'</textarea>';

    echo $html;
}

function tvds_footer_settings_cb(){
    echo '<p>Fill the footer with content.</p>';
}

function tvds_name_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[name]" value="'.$options['name'].'">';

    echo $html;
}

function tvds_address_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[address]" value="'.$options['address'].'">';

    echo $html;
}

function tvds_postal_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[postal]" value="'.$options['postal'].'">';

    echo $html;
}

function tvds_email_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[email]" value="'.$options['email'].'">';

    echo $html;
}

function tvds_kvk_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[kvk]" value="'.$options['kvk'].'">';

    echo $html;
}

function tvds_btw_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[btw]" value="'.$options['btw'].'">';

    echo $html;
}

function tvds_iban_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[iban]" value="'.$options['iban'].'">';

    echo $html;
}

function tvds_phone_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[phone]" value="'.$options['phone'].'">';

    echo $html;
}

function tvds_twitter_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[twitter]" value="'.$options['twitter'].'">';

    echo $html;
}

function tvds_google_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[google]" value="'.$options['google'].'">';

    echo $html;
}

function tvds_facebook_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[facebook]" value="'.$options['facebook'].'">';

    echo $html;
}

function tvds_linkedin_options_cb(){
    // First, we read the options collection
    $options = get_option('tvds_theme_display_options');

    // Next, we update the name attribute to access this element's ID in the context of the display options array
    $html = '<input type="text" id="address" name="tvds_theme_display_options[linkedin]" value="'.$options['linkedin'].'">';

    echo $html;
}