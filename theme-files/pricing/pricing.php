<?php
/*
 * PRICING FUNCTIONALITY
 */

/*
 * CUSTOM POST TYPE
 */
add_action('init', 'tvds_init_pricing_post_type');
function tvds_init_pricing_post_type(){
    $labels = array(
        'name'                  => 'Pricing',
        'singular_name'         => 'Pricing',
        'add_new'               => 'Add New', 'Pricing',
        'add_new_item'          => 'Add New Pricing',
        'edit_item'             => 'Edit Pricing',
        'new_item'              => 'New Pricing',
        'all_items'             => 'All Pricing',
        'view_item'             => 'View Pricing',
        'search_items'          => 'Search Pricing',
        'not_found'             => 'No pricing found',
        'not_found_in_trash'    => 'No pricing found in the Trash',
        'parent_item_colon'     => '',
        'menu_name'             => 'Pricing'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 8,
        'supports'              => array( 'title', 'editor'),
        'has_archive'           => false,
        'register_meta_box_cb'  => 'tvds_pricing_meta_box_cb'
    );
    register_post_type('pricing', $args);
}

/*
 * META BOXES
 */
function tvds_pricing_meta_box_cb(){
    add_meta_box('pricing_services', 'Services', 'tvds_pricing_services_meta_cb', 'pricing', 'normal', 'default');
    add_meta_box('pricing_price', 'Price', 'tvds_pricing_price_meta_cb', 'pricing', 'normal', 'default');
}

/*
 * META BOXES CALLBACK
 *
 * Here are the callbacks for the meta boxes
 * 1. Pricing Services
 * 2. Pricing Price
 */

// 1. Pricing Services
function tvds_pricing_services_meta_cb(){
    global $post;

    // Get the services that are checked
    $checked_services = get_post_meta($post->ID, '_pricing_check', true);

    // Get the services from the Pricing Options
    $options = get_option('tvds_theme_pricing_options');
    $services = $options['pricing'];
    $filtered = array_filter($services);

    // Nonce needed to verify where the data originated from
    echo '<input type="hidden" name="pricing_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'">';
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody>
        <?php
        foreach($filtered as $service){
            ?>
            <tr class="form-field">
                <th>
                    <label><?php echo $service ?></label>
                </th>
                <td>
                    <span>Include in the package?</span>
                </td>
                <td>
                    <?php
                    if(!empty($checked_services)){
                        if(in_array($service, $checked_services)){
                            echo '<input type="checkbox" name="_pricing_check[]" value="'.$service.'" checked >';
                        } else {
                            echo '<input type="checkbox" name="_pricing_check[]" value="'.$service.'">';
                        }
                    } else {
                        echo '<input type="checkbox" name="_pricing_check[]" value="'.$service.'">';
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}

//2. Pricing Price
function tvds_pricing_price_meta_cb(){
    global $post;
    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
        <tbody>
            <tr class="form-field">
                <th valign="top" scope="row">
                    <label for="price">Price</label>
                </th>
                <td>
                    <input id="price" name="_pricing_price" type="number" style="width: 95%" value="<?php echo get_post_meta($post->ID, '_pricing_price', true); ?>" size="50"
                           class="code" placeholder="choose a price"/>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}

/*
 * THE SAVE FUNCTION
 */
function tvds_save_pricing_meta($post_id){
    // Checks save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['pricing_nonce']) && wp_verify_nonce($_POST['pricing_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Exits script depending on save status
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return;
    }
    // Checks for input and sanitizes/saves if needed
    if(isset($_POST[ '_pricing_check' ])){
        update_post_meta($post_id, '_pricing_check', $_POST['_pricing_check']);
    }
    if(isset($_POST[ '_pricing_price' ])){
        update_post_meta($post_id, '_pricing_price', $_POST['_pricing_price']);
    }
}
add_action('save_post', 'tvds_save_pricing_meta');

