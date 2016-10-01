<?php

/*
  Plugin Name: Make Me Vip Connect
  Description: This plugin adds make me vip post view, update, delete functionality to site.
  Version: 1.0.0
  Author: http5000
 */

defined('ABSPATH') OR exit;

$plugin_name = plugin_basename(__FILE__);

define('MAKE_ME_VIP_POSTS_PLUGIN', __FILE__);

define('MAKE_ME_VIP_POSTS_PLUGIN_BASENAME', plugin_basename(MAKE_ME_VIP_POSTS_PLUGIN));

define('MAKE_ME_VIP_POSTS_PLUGIN_NAME', trim(dirname(MAKE_ME_VIP_POSTS_PLUGIN_BASENAME), '/'));

define('MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH', plugin_dir_path(__FILE__));

define('MAKE_ME_VIP_SERVER', 'https://www.makemevip.info');

//define('MAKE_ME_VIP_SERVER', 'http://www.test.makemevip.info');

require MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH . '/includes/' . 'make-mevip-post-init.php';

require MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH . '/includes/' . 'make-mevip-post-authenticate.php';

require MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH . '/includes/' . 'make-mevip-post-metabox.php';

require MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH . '/includes/' . 'make-mevip-post-functions.php';

//require MAKE_ME_VIP_POSTS_PLUGIN_DIRECTORY_PATH . '/includes/' . 'make-mevip-post-cron.php';

register_activation_hook(__FILE__, 'make_me_vip_connect_activation');
register_deactivation_hook(__FILE__, 'make_me_vip_connect_deactivation');
register_uninstall_hook(__FILE__, 'make_me_vip_connect_uninstallation');

function make_me_vip_connect_activation() {
    add_option('mmvip_post_publish_status');
    add_option('mmvip_post_sync_status');
    add_option('mmvip_post_category_display');

    $the_page_title = 'Make Me Vip Connect Page';
    $the_page_name = 'make-me-vip-connect-page';

    delete_option("my_plugin_page_title");
    add_option("my_plugin_page_title", $the_page_title, '', 'yes');
    // the slug...
    delete_option("my_plugin_page_name");
    add_option("my_plugin_page_name", $the_page_name, '', 'yes');
    // the id...
    delete_option("my_plugin_page_id");
    add_option("my_plugin_page_id", '0', '', 'yes');

    $the_page = get_page_by_title($the_page_title);

    if (!$the_page) {

        // Create post object
        $_p = array();
        $_p['post_title'] = $the_page_title;
        $_p['post_content'] = '[mmvip_post_cron]';
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1); // the default 'Uncatrgorised'
        // Insert the post into the database
        $the_page_id = wp_insert_post($_p);
    } else {
        // the plugin may have been previously active and the page may just be trashed...

        $the_page_id = $the_page->ID;

        //make sure the page is not trashed...
        $the_page->post_status = 'publish';
        $the_page_id = wp_update_post($the_page);
    }

    delete_option('my_plugin_page_id');
    add_option('my_plugin_page_id', $the_page_id);
    
}

function make_me_vip_connect_deactivation() {
    delete_option('mmvip_post_publish_status');
    delete_option('mmvip_post_sync_status');
    delete_option('mmvip_post_category_display');
    delete_option('mmvip_user_key');
    //delete_user_meta(get_current_user_id(), 'user_makemevip_key');

    global $wpdb;

    $the_page_title = get_option("my_plugin_page_title");
    $the_page_name = get_option("my_plugin_page_name");

    //  the id of our page...
    $the_page_id = get_option('my_plugin_page_id');
    if ($the_page_id) {

        wp_delete_post($the_page_id, true); // this will trash, not delete
    }

    delete_option("my_plugin_page_title");
    delete_option("my_plugin_page_name");
    delete_option("my_plugin_page_id");
    
}

function make_me_vip_connect_uninstallation() {
    
}