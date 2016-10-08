<?php

/**
 * Theme functions file
 *
 * DO NOT MODIFY THIS FILE. Make a child theme instead: http://codex.wordpress.org/Child_Themes
 *
 * @package ClassiPress
 * @author  AppThemes
 * @since   ClassiPress 1.0
 */
// Constants
define('CP_VERSION', '3.4');
define('CP_DB_VERSION', '2221');

define('APP_POST_TYPE', 'ad_listing');
define('APP_TAX_CAT', 'ad_cat');
define('APP_TAX_TAG', 'ad_tag');

define('CP_ITEM_LISTING', 'ad-listing');
define('CP_ITEM_MEMBERSHIP', 'membership-pack');

define('CP_PACKAGE_LISTING_PTYPE', 'package-listing');
define('CP_PACKAGE_MEMBERSHIP_PTYPE', 'package-membership');

define('APP_TD', 'classipress');

global $cp_options;

// Legacy variables - some plugins rely on them
$app_theme = 'ClassiPress';
$app_abbr = 'cp';
$app_version = '3.4';
$app_db_version = 2221;
$app_edition = 'Ultimate Edition';


// Framework
require_once( dirname(__FILE__) . '/framework/load.php' );
require_once( APP_FRAMEWORK_DIR . '/includes/stats.php' );
require_once( APP_FRAMEWORK_DIR . '/admin/class-meta-box.php' );

APP_Mail_From::init();

// define the transients we use
$app_transients = array('cp_cat_menu');

// define the db tables we use
$app_db_tables = array('cp_ad_fields', 'cp_ad_forms', 'cp_ad_geocodes', 'cp_ad_meta', 'cp_ad_packs', 'cp_ad_pop_daily', 'cp_ad_pop_total', 'cp_coupons', 'cp_order_info');

// register the db tables
foreach ($app_db_tables as $app_db_table) {
    scb_register_table($app_db_table);
}
scb_register_table('app_pop_daily', 'cp_ad_pop_daily');
scb_register_table('app_pop_total', 'cp_ad_pop_total');


$load_files = array(
    'checkout/load.php',
    'payments/load.php',
    'reports/load.php',
    'widgets/load.php',
    'options.php',
    'appthemes-functions.php',
    'actions.php',
    'categories.php',
    'comments.php',
    'core.php',
    'cron.php',
    'custom-forms.php',
    'custom-header.php',
    'deprecated.php',
    'enqueue.php',
    'emails.php',
    'functions.php',
    'hooks.php',
    'images.php',
    'packages.php',
    'payments.php',
    'profile.php',
    'search.php',
    'security.php',
    'stats.php',
    'views.php',
    'views-checkout.php',
    'widgets.php',
);
appthemes_load_files(dirname(__FILE__) . '/includes/', $load_files);

$load_classes = array(
    'CP_Blog_Archive',
    'CP_Posts_Tag_Archive',
    'CP_Author_Archive',
    'CP_Ads_Tag_Archive',
    'CP_Ads_Archive',
    'CP_Ads_Home',
    'CP_Ads_Categories',
    'CP_Add_New',
    'CP_Renew_Listing',
    'CP_Ad_Single',
    'CP_Edit_Item',
    'CP_Membership',
    'CP_User_Dashboard',
    'CP_User_Profile',
    // Checkout
    'CP_Membership_Form_Select',
    'CP_Membership_Form_Preview',
    'CP_Listing_Form_Select_Category',
    'CP_Listing_Form_Edit',
    'CP_Listing_Form_Details',
    'CP_Listing_Form_Preview',
    'CP_Listing_Form_Submit_Free',
    'CP_Gateway_Select',
    'CP_Gateway_Process',
    'CP_Order_Summary',
    // Widgets
    'CP_Widget_125_Ads',
    'CP_Widget_Ad_Categories',
    'CP_Widget_Ads_Tag_Cloud',
    'CP_Widget_Blog_Posts',
    'CP_Widget_Facebook',
    'CP_Widget_Featured_Ads',
    'CP_Widget_Search',
    'CP_Widget_Sold_Ads',
    'CP_Widget_Top_Ads_Today',
    'CP_Widget_Top_Ads_Overall',
);
appthemes_add_instance($load_classes);


// Admin only
if (is_admin()) {
    require_once( APP_FRAMEWORK_DIR . '/admin/importer.php' );

    $load_files = array(
        'admin.php',
        'dashboard.php',
        'enqueue.php',
        'install.php',
        'importer.php',
        'listing-single.php',
        'listing-list.php',
        'options.php',
        'package-single.php',
        'package-list.php',
        'settings.php',
        'system-info.php',
        'updates.php',
    );
    appthemes_load_files(dirname(__FILE__) . '/includes/admin/', $load_files);

    $load_classes = array(
        'CP_Theme_Dashboard',
        'CP_Theme_Settings_General' => $cp_options,
        'CP_Theme_Settings_Emails' => $cp_options,
        'CP_Theme_Settings_Pricing' => $cp_options,
        'CP_Theme_System_Info',
        'CP_Listing_Package_General_Metabox',
        'CP_Membership_Package_General_Metabox',
        'CP_Listing_Attachments_Metabox',
        'CP_Listing_Author_Metabox',
        'CP_Listing_Info_Metabox',
        'CP_Listing_Custom_Forms_Metabox',
        'CP_Listing_Pricing_Metabox',
    );
    appthemes_add_instance($load_classes);
}


// Frontend only
if (!is_admin()) {

    cp_load_all_page_templates();
}

// Constants
define('CP_DASHBOARD_URL', get_permalink(CP_User_Dashboard::get_id()));
define('CP_PROFILE_URL', get_permalink(CP_User_Profile::get_id()));
define('CP_EDIT_URL', get_permalink(CP_Edit_Item::get_id()));
define('CP_ADD_NEW_URL', get_permalink(CP_Add_New::get_id()));
define('CP_MEMBERSHIP_PURCHASE_URL', get_permalink(CP_Membership::get_id()));


// Theme supports
add_theme_support('app-versions', array(
    'update_page' => 'admin.php?page=app-settings&firstrun=1',
    'current_version' => CP_VERSION,
    'option_key' => 'cp_version',
));

add_theme_support('app-wrapping');

add_theme_support('app-search-index', array(
    'admin_page' => true,
    'admin_top_level_page' => 'app-dashboard',
    'admin_sub_level_page' => 'app-system-info',
));

add_theme_support('app-login', array(
    'login' => 'tpl-login.php',
    'register' => 'tpl-registration.php',
    'recover' => 'tpl-password-recovery.php',
    'reset' => 'tpl-password-reset.php',
    'redirect' => $cp_options->disable_wp_login,
    'settings_page' => 'admin.php?page=app-settings&tab=advanced',
));

add_theme_support('app-feed', array(
    'post_type' => APP_POST_TYPE,
    'blog_template' => 'index.php',
    'alternate_feed_url' => $cp_options->feedburner_url,
));

add_theme_support('app-open-graph', array(
    'default_image' => get_header_image() ? get_header_image() : appthemes_locate_template_uri('images/cp_logo_black.png'),
));

add_theme_support('app-payments', array(
    'items' => array(
        array(
            'type' => CP_ITEM_LISTING,
            'title' => __('Listing', APP_TD),
            'meta' => array(),
        ),
        array(
            'type' => CP_ITEM_MEMBERSHIP,
            'title' => __('Membership', APP_TD),
            'meta' => array(),
        ),
    ),
    'items_post_types' => array(APP_POST_TYPE),
    'options' => $cp_options,
));

add_theme_support('app-price-format', array(
    'currency_default' => $cp_options->currency_code,
    'currency_identifier' => $cp_options->currency_identifier,
    'currency_position' => $cp_options->currency_position,
    'thousands_separator' => $cp_options->thousands_separator,
    'decimal_separator' => $cp_options->decimal_separator,
    'hide_decimals' => $cp_options->hide_decimals,
));

add_theme_support('app-plupload', array(
    'max_file_size' => $cp_options->max_image_size,
    'allowed_files' => $cp_options->num_images,
    'disable_switch' => false,
));

add_theme_support('app-stats', array(
    'cache' => 'today',
    'table_daily' => 'cp_ad_pop_daily',
    'table_total' => 'cp_ad_pop_total',
    'meta_daily' => 'cp_daily_count',
    'meta_total' => 'cp_total_count',
));

add_theme_support('app-reports', array(
    'post_type' => array(APP_POST_TYPE),
    'options' => $cp_options,
    'admin_top_level_page' => 'app-dashboard',
    'admin_sub_level_page' => 'app-settings',
));

add_theme_support('app-comment-counts');

add_theme_support('post-thumbnails');

add_theme_support('automatic-feed-links');


// Set the content width based on the theme's design and stylesheet.
// Used to set the width of images and content. Should be equal to the width the theme
// is designed for, generally via the style.css stylesheet.
if (!isset($content_width)) {
    $content_width = 500;
}


appthemes_init();

// END ENQUEUE PARENT ACTION

add_action('wp_footer', 'custom_script');

function custom_script() {
    ?>

    <script>
        jQuery(document).ready(function () {
            jQuery('#list').click(function (event) {
                event.preventDefault();
                jQuery('#products .item').addClass('list-group-item');
                jQuery('.nav-hide').removeClass('hide');
                jQuery('.list-group-image').addClass('hide');
                jQuery('.list-group-item-heading').addClass('col-md-2');
                jQuery('.list-group-item-text').addClass('col-md-6');
                jQuery('.thumbnail').css('border','none');
                
            });
            jQuery('#grid').click(function (event) {
                event.preventDefault();
                jQuery('#products .item').removeClass('list-group-item');
                jQuery('#products .item').addClass('grid-group-item');
                jQuery('#products .item').addClass('grid-group-item');
                jQuery('.nav-hide').addClass('hide');
                jQuery('.list-group-image').removeClass('hide');
                jQuery('.list-group-item-text').removeClass('col-md-6');
                jQuery('.list-group-item-heading').removeClass('col-md-2');
                jQuery('.thumbnail').css('border','1px solid #ccc');
            });
        });
    </script>
    <?php

}
?>
