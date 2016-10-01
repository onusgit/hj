<?php

add_action("admin_menu", "add_make_mevip_menu");

function add_make_mevip_menu() {
    add_menu_page('Make Me Vip Connect', 'Make Me Vip Connect', 'manage_options', 'make-me-vip-connect', 'user_authentication', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME) . '/assets/images/RoundMMVIP_logo.svg', 99);
}

function enq_style() {
    //bootstrap switch

    wp_register_script('bootstrap_switch_js', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js'), array(), null, true);
    wp_enqueue_script('bootstrap_switch_js');

    wp_register_style('bootstrap_switch_css', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css'));
    wp_enqueue_style('bootstrap_switch_css');

    wp_register_style('style_css', plugins_url('/' . MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/css/style.css'));
    wp_enqueue_style('style_css');

    //unite gallery
//    wp_register_script('unite_gallery_js', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/js/unitegallery.min.js'), array(), null, true);
//    wp_enqueue_script('bootstrap_switch_js');
//    
//    wp_register_script('unite_gallery_tiles_themejs', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/themes/tiles/ug-theme-tiles.js'), array(), null, true);
//    wp_enqueue_script('unite_gallery_tiles_themejs');
//
//    wp_register_style('unite_gallery_css', plugins_url(MAKE_ME_VIP_POSTS_PLUGIN_NAME . '/assets/plugins/unitegallery/css/unite-gallery.css'));
//    wp_enqueue_style('unite_gallery_css');
}

add_action('admin_menu', 'enq_style');
