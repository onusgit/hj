<?php
defined('ABSPATH') OR exit;

add_action('admin_menu', 'my_create_post_meta_box');
add_action('post_updated', 'my_save_post_meta_box', 10, 2);

function my_create_post_meta_box() {
    add_meta_box('my-meta-box', 'Youtube video link', 'my_post_meta_box', 'post', 'normal', 'high');
}

function my_post_meta_box($object, $box) {
    ?>
    <p>
        <?php if (current_user_can('upload_files')) : ?>
        <div id="media-buttons" class="hide-if-no-js">
            <?php //do_action('media_buttons');  ?>
        </div>
    <?php endif; ?>
    <br />
    <label for="second-excerpt">Youtube video link</label><br/>
    <input type="text" name="post_youtube_link" id="second-excerpt" style="width: 100%" value = '<?php echo get_post_meta($object->ID, 'Youtube video link', true); ?>' />
    <input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
    </p>
    <?php
}

function my_save_post_meta_box($post_id, $post) {

//    if (!wp_verify_nonce($_POST['my_meta_box_nonce'], plugin_basename(__FILE__)))
//        return $post_id;

    // Autosave, do nothing
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// AJAX? Not used here
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// Check user permissions
    if (!current_user_can('edit_post', $post_id))
        return;
// Return if it's a post revision
    if (false !== wp_is_post_revision($post_id))
        return;

    if ($post->post_type != 'post')
        return;

    $new_meta_value = isset($_POST['post_youtube_link']) ? $_POST['post_youtube_link'] : '';
    update_post_meta($post_id, 'Youtube video link', $new_meta_value);
}

add_action('post_submitbox_misc_actions', 'publish_in_mmvip');
//add_action('add_meta_boxes', 'publish_in_mmvip');

function publish_in_mmvip($post) {
    global $post;

    if ($post->post_type == 'post'):
        $value = get_post_meta($post->ID, 'publish_in_mmvip', true);
        echo '<div class="misc-pub-section misc-pub-section-last">
             <span id="timestamp">'
        . '<label><input type="checkbox"' . (!empty($value) && $value == 1 ? ' checked="checked" ' : '') . 'value="1" name="publish_in_mmvip" /> publier sur mmvip</label>'
        . '</span></div>';
    endif;
}

add_action('post_updated', 'save_post_to_mmvip', 10, 2);

function save_post_to_mmvip($post_id, $post) {

// Autosave, do nothing
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
// AJAX? Not used here
    if (defined('DOING_AJAX') && DOING_AJAX)
        return;
// Check user permissions
    if (!current_user_can('edit_post', $post_id))
        return;
// Return if it's a post revision
    if (false !== wp_is_post_revision($post_id))
        return;
// If page    
    if ($post->post_type != 'post')
        return;

    if (isset($_POST['publish_in_mmvip']) && $_POST['publish_in_mmvip'] == 1):
        $publish_in_mmvip = 1;
    else:
        $publish_in_mmvip = 0;
    endif;

    update_post_meta($post_id, 'publish_in_mmvip', $publish_in_mmvip);

    if ($publish_in_mmvip == 1):
        // Save your work
        $mmvip_synch_status = get_option('mmvip_post_sync_status');
        if ($mmvip_synch_status && $mmvip_synch_status == 1):

            $youtube_link = get_post_meta($post_id, 'Youtube video link', true);
            //$key = get_user_meta(get_current_user_id(), 'user_makemevip_key');
            $key = get_option('mmvip_user_key');

            $thumbnail_id = get_post_thumbnail_id($post->ID);
            $post_thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
            $post_content_without_shortcode = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $post->post_content);

            $post_url = esc_url(get_permalink($post->ID));

            $postdata = "key=$key";
            $postdata .= "&Post[title]=$post->post_title";
            $postdata .= "&Post[content]=$post_content_without_shortcode";
            $postdata .= "&Post[publish_date]= $post->post_date";
            $postdata .= "&Post[youtube_link]=$youtube_link";
            $postdata .= "&Post[picture_url]=$post_thumbnail_url[0]";
            $postdata .= "&Post[post_url]=$post_url";
            $postdata .= "&Post[wordpress_post_id]=$post->ID";

            $curl = curl_init(MAKE_ME_VIP_SERVER . '/UserDashboard/wordpress_post_copy.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_USERPWD, 'admin@show-up.fr:http2013man');
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            $response = curl_exec($curl);
            $resultStatus = curl_getinfo($curl);
            curl_close($curl);
            $res = json_decode($response, true);
        else:
            exit;
        endif;
    endif;
}
