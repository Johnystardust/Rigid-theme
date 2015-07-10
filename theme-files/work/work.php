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
        'name'               => 'Projects',
        'singular_name'      => 'Project',
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
        'menu_name'          => 'Projects'
    );
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'menu_position'         => 6,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'           => false,
        'register_meta_box_cb'  => 'add_labels_meta_box',
        'taxonomies'            => array('category')
    );
    register_post_type( 'work', $args);
}

/*
 * META BOXES
 */
function add_labels_meta_box(){
    add_meta_box('work_labels', 'Labels', 'work_labels_meta_cb', 'work', 'side', 'default');
}

/*
 * META BOXES CALLBACK
 */
function work_labels_meta_cb(){
    global $post;

    // Nonce needed to verify where the data originated from
    echo '<input type="hidden" name="labels_nonce" value="'.wp_create_nonce(plugin_basename(__FILE__)).'">';



    // Get the default_labels
    $options = get_option('tvds_theme_work_options');
    $default_labels = $options['default_labels'];
    print_r($default_labels);
    echo '<br>';

    // Get the post meta
    $clicked_labels = get_post_meta($post->ID, '_labels', true);
    print_r($clicked_labels);

    ?>
    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table" xmlns="http://www.w3.org/1999/html">
        <tbody>
        <?php
        if(is_array($clicked_labels)){
            foreach($default_labels as $label){
                if(in_array($label, $clicked_labels)){
                    echo '<br><label><input type="checkbox" name="_labels[]" value="'.$label.'" checked>'.$label.'</label>';
                } else {
                    echo '<br><label><input type="checkbox" name="_labels[]" value="'.$label.'">'.$label.'</label>';
                }
            }
        } else {
            echo '<p>We have found no labels please select one or more.</p>';
            foreach($default_labels as $label){
                echo '<br><label><input type="checkbox" name="_labels[] value="'.$label.'">'.$label.'</label>';
            }
        }
        ?>
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
}
add_action('save_post', 'save_work_labels_meta');