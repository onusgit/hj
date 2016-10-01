<?php

defined('ABSPATH') OR exit;

//add_action( 'wp', 'prefixsetupschedule' );
//add_action( 'init', 'prefixsetupschedule' );

/**
 * On an early action hook, check if the hook is scheduled - if not, schedule it.
 */
function prefixsetupschedule() {
    if (!wp_next_scheduled('prefixhourlyevent')) {
        wp_schedule_event(time(), '5min', 'prefixhourlyevent');
    }
}

add_action('prefixhourlyevent', 'prefixdothishourly');

/**
 * On the scheduled action hook, run a function.
 */
function prefixdothishourly() {
    get_all_mmvip_posts();
    return wp_mail("dhananjay.onus@gmail.com", "Notification TEST", "TEST", null);
}

function my_cron_schedules($schedules) {
    if (!isset($schedules["5min"])) {
        $schedules["5min"] = array(
            'interval' => 10,
            'display' => __('Once every 5 minutes'));
    }
    if (!isset($schedules["30min"])) {
        $schedules["30min"] = array(
            'interval' => 30 * 60,
            'display' => __('Once every 30 minutes'));
    }
    return $schedules;
}

add_filter('cron_schedules', 'my_cron_schedules');

//un schedule cron 

add_action('stop_cron_hook','stop_cron');
function stop_cron() {
// Get the timestamp of the next scheduled run
    wp_clear_scheduled_hook('prefixhourlyevent');

    $timestamp = wp_next_scheduled('prefixhourlyevent');
// Un-schedule the event
    wp_unschedule_event($timestamp, 'prefixhourlyevent');
}
