<?php

// define constants
define('TVDS_SHORTNAME', 'tvds');
define('TVDS_PAGE_BASENAME', 'theme-settings');

// specify hooks
add_action('admin_menu', 'tvds_add_settings_menu');
add_action('admin_init', 'tvds_register_settings');

// include required files
    // page settings sections & fields
require_once('theme-options.php');

// helper function for defining variables for the current page
function tvds_get_settings(){
    $output = array();

    // put together the output array
    $output['tvds_option_name']     = 'tvds_options';
    $output['tvds_page_title']      = 'Theme Settings page';
    $output['tvds_page_sections']   = tvds_options_page_sections();
    $output['tvds_page_fields']     = tvds_options_page_fields();
    $output['tvds_contextual_help'] = tvds_options_page_contextual_help();

    return $output;
}

// helper function for registering our form field settings
function tvds_create_settings_field($args = array()){
    // default array to overwrite when calling the function
    $defaults = array(
        'id'        => 'default_field',                     // the ID of the setting in our options array, and the id of the html form element
        'title'     => 'Default Field',                     // the label for the HTML form element
        'desc'      => 'This is the default description',   // the description displayed under the HTML form element
        'std'       => '',                                  // the default value for this setting
        'type'      => 'text',                              // the HTML form element to use
        'section'   => 'main_section',                      // the section this setting belongs to - must watch the array key of a section in tvds_options_page_sections()
        'choices'   => array(),                             // (optional): the values in radio buttons or a drop-down menu
        'class'     => ''                                   // the HTML form element class. Also used for validation purposes!
    );

    // extract to be able to use the array keys as variables in our function output below
    extract(wp_parse_args($args, $defaults));

    // additional arguments for use in form field output in the function tvds_form_field_cb()!
    $field_args = array(
        'type'      => $type,
        'id'        => $id,
        'desc'      => $desc,
        'std'       => $std,
        'choices'   => $choices,
        'label_for' => $id,
        'class'     => $class
    );

    add_settings_field($id, $title, 'tvds_form_field_cb', __FILE__, $section, $field_args);
}

// register our setting
function tvds_register_settings(){
    // get the settings sections array
    $settings_output    = tvds_get_settings();
    $tvds_option_name   = $settings_output['tvds_option_name'];

    // setting,
    // register_setting($options_group, $option_name, $sanitize_callback);
    register_setting($tvds_option_name, $tvds_option_name, 'tvds_validate_options');

    // sections
    // add_settings_section($id, $title, $callback, $page);
    if(!empty($settings_output['tvds_page_sections'])){
        // call the add_settings_section for each!
        foreach($settings_output['tvds_page_sections'] as $id => $title){
            add_settings_section($id, $title, 'tvds_section_cb', __FILE__);
        }
    }

    // fields
    if(!empty($settings_output['tvds_page_fields'])){
        // call the create settings field for each!
        foreach($settings_output['tvds_page_fields'] as $option){
            tvds_create_settings_field($option);
        }
    }
}

// section HTML displayed before the first option
function tvds_section_cb($desc){
    echo '<p>Settings for this section</p>';
}

// form fields html
// all form field types share the same function!!
function tvds_form_field_cb($args = array()){
    extract($args);

    // get the settings array
    $settings_output = tvds_get_settings();

    $tvds_option_name   = $settings_output['tvds_option_name'];
    $options            = get_option($tvds_option_name);

    // pass the standard value id the option is not yet set in the database
    if(!isset($options[$id]) && 'type' != 'checkbox'){
        $options[$id] = $std;
    }

    // additional field class. output only if the class is defined in the create_setting arguments
    $field_class = ($class != '') ? ' ' . $class : '';

    // switch html display based on the setting type
    switch($type){
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr($options[$id]);
            echo "<input class='regular-text$field_class' type='text' id='$id' name='".$tvds_option_name."[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'multi-text':
            foreach($choices as $item){
                $item = explode("|", $item); // cat_name|slug_name
                $item[0] = esc_html($item[0]);
                if(!empty($options[$id])){
                    foreach($options[$id] as $option_key => $option_val){
                        if($item[1] == $option_key){
                            $value = $option_val;
                        }
                    }
                } else {
                    $value = '';
                }
                echo "<span>$item[0]:</span> <input class='$field_class' type='text' id='$id|$item[1]' name='".$tvds_option_name."[[$id]|$item[1]]' value='$value' ><br/>";
            }
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'textarea':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_html($options[$id]);
            echo "<textarea class='textarea$field_class' type='text' id='$id' name='".$tvds_option_name."[$id]' rows='5' cols='30'>$options[$id]</textarea>";
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'select':
            echo "<select id='$id' class='select$field_class' name='".$tvds_option_name."[$id]'>";
            foreach($choices as $item){
                $value  = esc_attr($item);
                $item   = esc_html($item);

                $selected = ($options[$id]==$value) ? 'selected="selected"' : '';
                echo "<option value='$value' $selected>$item</option>";
            }
            echo "</select>";
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'select2':
            echo "<select id='$id' class='select$field_class' name='".$tvds_option_name."[$id]'>";
            foreach($choices as $item){
                $item = explode("|", $item);
                $item[0] = esc_html($item[0]);

                $selected = ($options[$id]==$item[1]) ? 'selected="selected"' : "";
                echo "<option value='$item[1]' $selected>$item[0]</option>";
            }
            echo "</select>";
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'checkbox':
            echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='".$tvds_option_name."[$id]' value='1' " .checked($options[$id], 1, false)."/>";
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;

        case 'multi-checkbox':
            foreach($choices as $item){
                $item = explode("|",$item);
                $item[0] = esc_html($item[0]);

                $checked = '';

                if(isset($options[$id][$item[1]])){
                    if($options[$id][$item[1]] == true){
                        $checked = 'checked="checked"';
                    }
                }
                echo "<input class='checkbox$field_class' type='checkbox' id='$id|$item[1]' name='".$tvds_option_name."[$id|$item[1]]' value='1' $checked />$item[0]<br/>";
            }
            echo($desc != '') ? "<br/><span class='description'>$desc</span>" : "";
        break;
    }
}

// admin menu page
function tvds_add_settings_menu(){
    // Display settings page link under the Appearance admin menu
    $tvds_settings_page = add_theme_page('theme settings', 'Theme settings', 'manage_options', TVDS_PAGE_BASENAME, 'tvds_settings_page_cb');
}

// admin settings page html
function tvds_settings_page_cb(){
    // get the settings sections array
    $settings_output = tvds_get_settings();
    ?>
    <div class="wrap">
        <h2><?php echo $settings_output['tvds_page_title']; ?></h2>

        <form action="options.php" method="POST">
            <?php
            // http://codex.wordpress.org/Function_Reference/settings_fields
            settings_fields($settings_output['tvds_option_name']);
            // http://codex.wordpress.org/Function_Reference/do_settings_sections
            do_settings_sections(__FILE__);
            ?>
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="Save Changes">
            </p>
        </form>
    </div>
    <?php
}

// validate input
function tvds_validate_options($input){
    // for enhanced security create a new empty array
    $valid_input = array();

    // collect only the values we expect and fill the new $valid_input array i.e. whitelist our option IDs

    // get the setting sections array
    $settings_output = tvds_get_settings();
    $options = $settings_output['tvds_page_fields'];

    // run a foreach and switch on option type
    foreach($options as $option){
        switch($option['type']){
            case 'text':
                // switch validation based on the clas
                switch($option['class']){
                    // for numeric
                    case 'numeric':
                        // accept the input only when numeric!
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';

                        // register error
                        if(is_numeric($input[$option['id']]) == FALSE){
                            add_settings_error(
                                $option['id'],                              // setting title
                                TVDS_SHORTNAME .'_txt_numeric_error',       // error ID
                                'Expecting a Numeric value! Please fix.',   // error message
                                'error'                                     // type of message
                            );
                        }
                    break;

                    // for multi-numeric values (spaced by a comma)
                    case 'multinumeric':
                        // accept the input only when numeric values are comma separated
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace

                        if($input[$option['id']] !=''){
                            // /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.
                            $valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : 'Expecting comma separated numeric values';
                        } else {
                            $valid_input[$option['id']] = $input[$option['id']];
                        }

                        // register error
                        if($input[$options['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1){
                            add_settings_error(
                                $option['id'],                                              // setting title
                                TVDS_SHORTNAME .'_txt_multinumeric_error',                  // error ID
                                'Expecting comma separated numeric values! Please fix.',    // error message
                                'error'                                                     // type of message
                            );
                        }
                    break;

                    // for no html
                    case 'nohtml':
                        // accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']]       = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;

                    // for url
                    case 'url':
                        // accept the input only when the url has been sanited for database usage with esc_url_raw()
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;

                    // for email
                    case 'email':
                        // accept the input only after the email has been validated
                        $input[$option['id']] = trim($input[$option['id']]); // trim whitespace
                        if($input[$option['id']] != ''){
                            $valid_input[$option['id']] = (is_email($input[$option['id']]) !== FALSE) ? $input[$option['id']] : 'Invalid email! Please re-enter!';
                        } elseif($input[$option['id']] = '') {
                            $valid_input[$option['id']] = 'This setting field cannot be empty! Please enter a valid email address';
                        }

                        // register error
                        if(is_email($input[$option['id']]) == FALSE || $input[$option['id']] == ''){
                            add_settings_error(
                                $option['id'],                                              // setting title
                                TVDS_SHORTNAME .'_txt_email_error',                         // error ID
                                'Please enter a valid email address!',                      // error message
                                'error'                                                     // type of message
                            );
                        }
                    break;

                    // a cover-all fall-back when the class argument is not set
                    default:
                        // accept only a few inline html elements
                        $allowed_html = array(
                            'a'         => array('href' => array(), 'title' => array()),
                            'b'         => array(),
                            'em'        => array(),
                            'i'         => array(),
                            'strong'    => array()
                        );

                        $input[$option['id']]       = trim($input[$option['id']]);                          // trim whitespace
                        $input[$option['id']]       = force_balance_tags($input[$option['id']]);            // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']]       = wp_kses($input[$option['id']], $allowed_html);        // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;
                }
            break;

            case 'multi-text':
                // this will hold the text values as an array of 'key' => 'value'
                unset($textarray);
                $text_values = array();

                foreach($option['choices'] as $k => $v){
                    // explode the connective
                    $pieces = explode("|", $v);

                    $text_values[] = $pieces[1];
                }

                foreach($text_values as $v){
                    // check that the options isn't empty
                    if(!empty($input[$option['id'].'|'.$v])){
                        // if it's not null, make sure it's sanitized, add it to an array
                        switch($option['class']){
                            // different sanitation actions based on the class, create you own cases as you need them

                            // for numeric input
                            case 'numeric':
                                // accept the input only if numeric!
                                $input[$option['id'].'|'.$v] = sanitize_text_field($input[$option['id'].'|'.$v]); // need to add slashes still before sending to database
                                $input[$option['id'].'|'.$v] = addslashes($input[$option['id'].'|'.$v]);
                            break;
                        }
                        // pass the sanitized user input to our $textarray array
                        $textarray[$v] = $input[$option['id'].'|'.$v];
                    } else {
                        $textarray[$v] = '';
                    }
                }
                // pass the non-empty $textarray to our $valid_input array
                if(!empty($textarray)){
                    $valid_input[$option['id']] = $textarray;
                }
            break;

            case 'textarea':
                // switch validation based on the class!
                switch($option['class']){
                    // for only inline html
                    case 'inlinehtml':
                        // accept only inline html
                        $input[$option['id']]       = trim($input[$option['id']]);                  // trim whitespace
                        $input[$option['id']]       = force_balance_tags($input[$option['id']]);    // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']]       = addslashes($input[$option['id']]);            // wp_filter_kses expects content to be escaped!
                        $valid_input[$option['id']] = wp_filter_kses($input[$option['id']]);        // call stripslashes then addslashes
                    break;

                    // for no html
                    case 'nohmtl':
                        // accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']]       = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;

                    // for allowlinebreaks
                    case 'allowlinebreaks':
                        // accept the input only after stripping out all html, extra white space etc!
                        $input[$option['id']]       = wp_strip_all_tags($input[$option['id']]); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;

                    // a cover-all fall-back when the class argument is not set
                    default:
                        // accept only limited html
                        $allowed_html = array(
                            'a'             => array('href' => array (),'title' => array ()),
                            'b'             => array(),
                            'blockquote'    => array('cite' => array ()),
                            'br'            => array(),
                            'dd'            => array(),
                            'dl'            => array(),
                            'dt'            => array(),
                            'em'            => array (),
                            'i'             => array (),
                            'li'            => array(),
                            'ol'            => array(),
                            'p'             => array(),
                            'q'             => array('cite' => array ()),
                            'strong'        => array(),
                            'ul'            => array(),
                            'h1'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                            'h2'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                            'h3'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                            'h4'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                            'h5'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
                            'h6'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
                        );

                        $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace
                        $input[$option['id']]       = force_balance_tags($input[$option['id']]);    // find incorrectly nested or missing closing tags and fix markup
                        $input[$option['id']]       = wp_kses($input[$option['id']], $allowed_html); // need to add slashes still before sending to the database
                        $valid_input[$option['id']] = addslashes($input[$option['id']]);
                    break;
                }
            break;

            case 'select':
                // check to see if the selected value is in our approved array of values
                $valid_input[$option['id']] = (in_array($input[$option['id']], $option['choices']) ? $input[$option['id']] : '');
            break;

            case 'select2':
                // process $select_values
                $select_values = array();
                foreach($option['choices'] as $k => $v){
                    $pieces = explode("|", $v);

                    $select_values[] = $pieces[1];
                }
                // check to see if selected value is in our approved array of values!
                $valid_input[$option['id']] = (in_array($input[$option['id']], $select_values) ? $input[$option['id']] : '');
            break;

            case 'checkbox':
                // if it's not set, default to null!
                if(!isset($input[$option['id']])){
                    $input[$option['id']] = null;
                }
                // our checkbox value is either 0 or 1
                $valid_input[$option['id']] = ($input[$option['id']] == 1 ? 1 : 0);
            break;

            case 'multi-checkbox':
                unset($checkboxarray);
                $check_values = array();

                foreach($option['choices'] as $k => $v){
                    // explode the connective
                    $pieces = explode("|", $v);

                    $check_values[] = $pieces[1];
                }

                foreach($check_values as $v){
                    // check that the option isn't full
                    if(!empty($input[$option['id'].'|'.$v])){
                        // if it's not null, make sure it's true, add it to an array
                        $checkboxarray[$v] = 'true';
                    } else {
                        $checkboxarray[$v] = 'false';
                    }
                }
                // take all the items that were checked, and set them as the main option
                if(!empty($checkboxarray)){
                    $valid_input[$option['id']] = $checkboxarray;
                }
            break;
        }
    }
    return $valid_input;
}

// helper function for creating admin messages
function tvds_show_msg($message, $msgclass = 'info'){
    echo "<div id='message' class='$msgclass'>$message</div>";
}

function tvds_admin_msgs(){
    // check for our settings page - need this in conditional further down
    $tvds_settings_pg = strpos($_GET['page'], TVDS_PAGE_BASENAME);
    // collect setting errors/notices
    $set_errors = get_settings_errors();

    // display admin message only for the admin to see, only on our settings page and only when setting errors/notices are returned
    if(current_user_can('manage_options') && $tvds_settings_pg !== FALSE && !empty($set_errors)){
        //have our settings successfully been updated?
        if($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])){
            tvds_show_msg("<p>".$set_errors[0]['message']."</p>", 'updated');
        }
        else { //have errors been found?
            //there may be more than one so run a foreach loop
            foreach($set_errors as $set_error){
                // set the tit;e attribute to match the error "setting title" - need this in js file
                tvds_show_msg("<p class='setting-error-message' title='".$set_error['setting']."'>".$set_error['message']."</p>", 'error');
            }
        }
    }
}
// admin messages hook
add_action('admin_notices', 'tvds_admin_msgs');