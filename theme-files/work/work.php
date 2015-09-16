<?php
/*
 * WORK FUNCTIONALITY
 */

/*
 * CUSTOM POST TYPE
 */
add_action( 'init', 'create_work_post_type' );
function create_work_post_type() {
    $labels = array(
        'name'               => 'Werk',
        'singular_name'      => 'Werk',
        'add_new'            => 'Add New', 'Project',
        'add_new_item'       => 'Add New Project',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'New Project',
        'all_items'          => 'All Project',
        'view_item'          => 'View Project',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No projects found',
        'not_found_in_trash' => 'No project found in the Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Werk'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 6,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'           => true,
        'register_meta_box_cb'  => 'add_meta_boxes',
        'taxonomies'            => array('category')
    );
    register_post_type( 'werk', $args);
}

/*
 * META BOXES
 */
function add_meta_boxes(){
    add_meta_box('work_labels', 'Labels', 'work_labels_meta_cb', 'werk', 'side', 'default');
    add_meta_box('work_header_img', 'Header', 'work_header_img_meta_cb', 'werk', 'normal', 'default');
    add_meta_box('work_big_img', 'Big Image', 'work_big_img_meta_cb', 'werk', 'normal', 'default');
}

/*
 * META BOXES CALLBACK
 *
 * Here are the callbacks for the meta boxes
 * 1. Labels
 * 2. Header
 * 3. Big Image
 */

//1. Labels
function work_labels_meta_cb(){
    global $post;

    // Nonce needed to verify where the data originated from
    echo '<input type="hidden" name="labels_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'">';

    // Get the default_labels
    $options = get_option('tvds_theme_work_options');
    $default_labels = $options['default_labels'];

    // Get the post meta
    $clicked_labels = get_post_meta($post->ID, '_labels', true);

    print_r($clicked_labels);

    $i = 0;

    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" xmlns="http://www.w3.org/1999/html">
        <tbody>
        <?php

        // Check if $clicked_labels is array
        if(is_array($clicked_labels)){
            foreach($default_labels as $label){
                // Check if the $label is in the $clicked_labels
                if(in_array($label, $clicked_labels)){
                    ?>
                    <br><label><input type="checkbox" onclick="var input = document.getElementById('checkbox<?php echo $i; ?>');" name="_labels[<?php echo $i; ?>][name]" value="<?php echo $label['name']; ?>" checked><?php echo $label['name']; ?>
                    <input id="checkbox<?php echo $i; ?>" type="hidden" name="_labels[<?php echo $i; ?>][icon]" value="<?php echo $label['icon']; ?>"/></label>
                    <?php
                } else {
                    ?>
                    <br><label><input type="checkbox" onclick="var input = document.getElementById('checkbox<?php echo $i; ?>'); if(this.checked){ input.disabled = false;} else{input.disabled = true;}" name="_labels[<?php echo $i; ?>][name]" value="<?php echo $label['name']; ?>"><?php echo $label['name']; ?>
                    <input disabled="disabled" id="checkbox<?php echo $i; ?>" type="hidden" name="_labels[<?php echo $i; ?>][icon]" value="<?php echo $label['icon']; ?>"/></label>
                    <?php
                }
                $i ++;
            }
        } else {
            echo '<p>We have found no labels please select one or more.</p>';
            foreach($default_labels as $label){
                ?>
                <br><label><input type="checkbox" onclick="document.getElementById('checkbox<?php echo $i; ?>').value = <?php echo $label['icon']; ?>;" name="_labels[<?php echo $i; ?>][name]" value="<?php echo $label['name']; ?>"><?php echo $label['name']; ?>
                <input id="checkbox<?php echo $i; ?>" type="hidden" name="_labels[<?php echo $i; ?>][icon]" value=""/></label>
                <?php
                $i ++;
            }
        }
        ?>
        </tbody>
    </table>

<?php
}
//2. Header
function work_header_img_meta_cb(){
    global $post;
    ?>

    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="header_link">Header Link</label>
            </th>
            <td>
                <input id="header_link" name="_header_link" type="text" style="width: 95%" value="<?php echo get_post_meta($post->ID, '_header_link', true); ?>" size="50"
                       class="code" placeholder="http://www."/>
            </td>
        </tr>
        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="client_link">Client Link</label>
            </th>
            <td>
                <input id="client_link" name="_client_link" type="text" style="width: 95%" value="<?php echo get_post_meta($post->ID, '_client_link', true); ?>" size="50"
                       class="code" placeholder="Client Name"/>
            </td>
        </tr>

        <?php

        $image_src  = '';
        $image_id   = get_post_meta( $post->ID, '_header_img', true );
        $image_src  = wp_get_attachment_url( $image_id );

        ?>

        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="header-image">Header Image</label>
            </th>
            <td>
                <img id="header-image" src="<?php echo $image_src ?>" style="max-width:100%;" />
                <input type="hidden" name="upload_header_image_id" id="upload_header_image_id" value="<?php echo $image_id; ?>" />
                <p>
                    <a class="button" title="<?php esc_attr_e( 'Set Header image' ) ?>" href="#" id="set-header-image"><?php _e( 'Set Header image' ) ?></a>
                    <a class="button" title="<?php esc_attr_e( 'Remove Header image' ) ?>" href="#" id="remove-header-image" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove Header image' ) ?></a>
                </p>
            </td>
        </tr>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                // Save the send_to_editor handler function
                window.send_to_editor_default = window.send_to_editor;

                // Set the image
                $('#set-header-image').click(function(){
                    // replace the default send_to_editor handler function with our own
                    window.send_to_editor = window.attach_header_image;
                    tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                    return false;
                });

                // Remove the image
                $('#remove-header-image').click(function() {

                    $('#upload_header_image_id').val('');           // clear the value of the upload ID
                    $('#header-image').attr('src', '');             // clear the img attribute
                    $(this).hide();                                 // Hide the remove header button

                    return false;
                });

                // Handler function which is invoked after the user selects an image from the gallery popup.
                // This function displays the image and sets the id so it can be persisted to the post meta
                window.attach_header_image = function(html) {

                    // Turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                    $('body').append('<div id="temp_header_image">' + html + '</div>');

                    var img = $('#temp_header_image').find('img');

                    imgurl   = img.attr('src');
                    imgclass = img.attr('class');
                    imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                    $('#upload_header_image_id').val(imgid);
                    $('#remove-header-image').show();

                    $('img#header-image').attr('src', imgurl);
                    try{tb_remove();}catch(e){};
                    $('#temp_header_image').remove();

                    // restore the send_to_editor handler function
                    window.send_to_editor = window.send_to_editor_default;
                }

            });
        </script>
        </tbody>
    </table>
    <?php
}

//3. Big Image
function work_big_img_meta_cb(){
    global $post;

    $image_src = '';

    $image_id = get_post_meta( $post->ID, '_big_img', true );
    $image_src = wp_get_attachment_url( $image_id );

    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody>


        <tr class="form-field">
            <th valign="top" scope="row">
                <label for="big-image">Big Image</label>
            </th>
            <td>
                <img id="big-image" src="<?php echo $image_src ?>" style="max-width:100%;" />
                <input type="hidden" name="upload_big_image_id" id="upload_big_image_id" value="<?php echo $image_id; ?>" />
                <p>
                    <a class="button" title="<?php esc_attr_e( 'Set Big image' ) ?>" href="#" id="set-big-image"><?php _e( 'Set Big image' ) ?></a>
                    <a class="button" title="<?php esc_attr_e( 'Remove Big image' ) ?>" href="#" id="remove-big-image" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"><?php _e( 'Remove Big image' ) ?></a>
                </p>
            </td>
        </tr>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                // save the send_to_editor handler function
                window.send_to_editor_default = window.send_to_editor;

                // Set the image
                $('#set-big-image').click(function(){
                    // replace the default send_to_editor handler function with our own
                    window.send_to_editor = window.attach_image;
                    tb_show('', 'media-upload.php?post_id=<?php echo $post->ID ?>&amp;type=image&amp;TB_iframe=true');

                    return false;
                });

                // Remove the image
                $('#remove-big-image').click(function() {

                    $('#upload_big_image_id').val('');              // Clear the value of the upload ID
                    $('#big-image').attr('src', '');                // Clear the image attribute
                    $(this).hide();                                 // Hide the remove button

                    return false;
                });

                // handler function which is invoked after the user selects an image from the gallery popup.
                // this function displays the image and sets the id so it can be persisted to the post meta
                window.attach_image = function(html) {

                    // turn the returned image html into a hidden image element so we can easily pull the relevant attributes we need
                    $('body').append('<div id="temp_image">' + html + '</div>');

                    var img = $('#temp_image').find('img');

                    imgurl   = img.attr('src');
                    imgclass = img.attr('class');
                    imgid    = parseInt(imgclass.replace(/\D/g, ''), 10);

                    $('#upload_big_image_id').val(imgid);
                    $('#remove-big-image').show();

                    $('img#big-image').attr('src', imgurl);
                    try{tb_remove();}catch(e){};
                    $('#temp_image').remove();

                    // restore the send_to_editor handler function
                    window.send_to_editor = window.send_to_editor_default;
                }

            });
        </script>
        </tbody>
    </table>
    <?php
}

/*
 * THE SAVE FUNCTION
 */

function save_work_labels_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['labels_nonce']) && wp_verify_nonce($_POST['labels_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    // Checks for input and sanitizes/saves if needed
    if(isset($_POST[ '_labels' ])){
        update_post_meta($post_id, '_labels', $_POST['_labels']);
    }
    if(isset($_POST[ '_header_link' ])){
        update_post_meta($post_id, '_header_link', $_POST['_header_link']);
    }
    if(isset($_POST['_client_link'])){
        update_post_meta($post_id, '_client_link', $_POST['_client_link']);
    }
    if(isset($_POST[ 'upload_header_image_id' ])){
        update_post_meta($post_id, '_header_img', $_POST['upload_header_image_id']);
    }
    if(isset($_POST[ 'upload_big_image_id' ])){
        update_post_meta($post_id, '_big_img', $_POST['upload_big_image_id']);
    }
}
add_action('save_post', 'save_work_labels_meta');