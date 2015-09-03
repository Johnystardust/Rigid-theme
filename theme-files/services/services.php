<?php
/*
 * SERVICES FUNCTIONALITY
 */

// Enqueue custom stylesheets
add_action('admin_init', 'add_my_admin_scripts');
function add_my_admin_scripts(){
    wp_register_style('my_fontello', get_stylesheet_directory_uri().'/includes/fontello/fontello-embedded.css');
    wp_register_style('my_admin_style', get_template_directory_uri().'/theme-files/services/icon-selection.css');

    wp_enqueue_style('my_fontello');
    wp_enqueue_style('my_admin_style');
}

/*
 * CUSTOM POST TYPE
 */
add_action('init', 'tvds_init_services_post_type');
function tvds_init_services_post_type(){
    $labels = array(
        'name'                  => 'Services',
        'singular_name'         => 'Service',
        'add_new'               => 'Add New', 'Service',
        'add_new_item'          => 'Add New Service',
        'edit_item'             => 'Edit Service',
        'new_item'              => 'New Service',
        'all_items'             => 'All Services',
        'view_item'             => 'View Service',
        'search_items'          => 'Search Service',
        'not_found'             => 'No service found',
        'not_found_in_trash'    => 'No service found in the Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Services'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 7,
        'supports'              => array('title', 'editor'),
        'has_archive'           => false,
        'register_meta_box_cb'  => 'tvds_service_meta_box_cb'
    );
    register_post_type('service', $args);
}

/*
 * META BOXES
 */
function tvds_service_meta_box_cb(){
    add_meta_box('service_description', 'Small Description', 'tvds_service_description_meta_cb', 'service', 'normal', 'default');
    add_meta_box('service_icon', 'Icon', 'tvds_service_icon_meta_cb', 'service', 'normal', 'default');
}

/*
 * META BOXES CALLBACK
 *
 * 1. Small Description
 * 2. Icon
 */

// 1. Small Description
function tvds_service_description_meta_cb(){
    global $post;
    ?>

    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" >
        <tbody>
        <tr class="form-field">
            <td>
                <textarea name="_service_description" id="description" rows="5" placeholder="write a small description" style="resize: vertical; width: 100%"><?php echo get_post_meta($post->ID, '_service_description', true); ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>

<?php
}

// 2. Icon
function tvds_service_icon_meta_cb(){
    global $post;

    // Nonce needed to verify where the data originated from
    echo '<input type="hidden" name="services_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'">';

    // All the icons in a array
    $icons = array(
        'icon-ok',
        'icon-ok-circled',
        'icon-cancel',
        'icon-cancel-circled',
        'icon-cancel-circled2',
        'icon-ok-circled2',
        'icon-down-open',
        'icon-left-open',
        'icon-right-open',
        'icon-up-open',
        'icon-css3',
        'icon-html5',
        'icon-vimeo',
        'icon-vimeo-circled',
        'icon-twitter',
        'icon-twitter-circled',
        'icon-facebook',
        'icon-facebook-circled',
        'icon-facebook-squared',
        'icon-gplus',
        'icon-gplus-circled',
        'icon-pinterest',
        'icon-pinterest-circled',
        'icon-tumblr',
        'icon-tumblr-circled',
        'icon-linkedin',
        'icon-linkedin-circled',
        'icon-monitor',
        'icon-mobile',
        'icon-tablet',
        'icon-wordpress',
        'icon-wordpress-1',
        'icon-angle-circled-left',
        'icon-angle-circled-right',
        'icon-angle-circled-up',
        'icon-angle-circled-down',
        'icon-zoom-in',
        'icon-zoom-out',
        'icon-local-seo',
        'icon-signal',
        'icon-database',
        'icon-brush',
        'icon-puzzle',
        'icon-layers',
        'icon-brush-alt',
        'icon-post',
        'icon-resize-small',
        'icon-link',
        'icon-link-1',
        'icon-resize-small-1',
        'icon-resize-full-alt',
        'icon-resize-small-alt',
        'icon-link-2',
        'icon-link-3',
        'icon-link-4',
        'icon-search',
        'icon-arrows-cw',
        'icon-ccw',
        'icon-cw',
    );

    // The selected icon
    $selected_icon = get_post_meta($post->ID, '_icon', true);
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <?php
        foreach($icons as $icon){
            ?>
            <div class="icon-selection">
                <i class="<?php echo $icon ?>"></i>
                <p><?php echo $icon ?></p>
                <?php echo '<input type="checkbox" name="_icon" value="'.$icon.'" '.checked($icon, $selected_icon, false).'>' ?>
            </div>
            <?php
        }
        ?>
    </table>
    <?php
}

/*
 * THE SAVE FUNCTION
 */
function tvds_save_services_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['services_nonce']) && wp_verify_nonce($_POST['services_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    // Checks for input and sanitizes/saves if needed
    if(isset($_POST['_service_description'])){
        update_post_meta($post_id, '_service_description', $_POST['_service_description']);
    }
    if(isset($_POST[ '_icon' ])){
        update_post_meta($post_id, '_icon', $_POST['_icon']);
    }
}
add_action('save_post', 'tvds_save_services_meta');