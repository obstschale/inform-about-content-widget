<?php
/**
 * Plugin Name:     Inform About Content Widget
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          Hans-Helge Buerger
 * Author URI:      https://hanshelgebuerger.de
 * Text Domain:     inform-about-content-widget
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Inform_About_Content_Widget
 */

if ( ! class_exists('IAC_Widget')) {
    require_once __DIR__ . '/src/IAC_Widget.php';
}

// load the plugin
add_action('plugins_loaded', function () {
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_script('iac_widget_ajax', plugins_url('assets/iac_widget.js', __FILE__), ['jquery', 'jquery-form']);
    });

    add_action('widgets_init', function () {
        return register_widget("IAC_Widget");
    });

    add_action('wp_ajax_iac_widget_action', function () {
        $informPosts = $_POST['inform_about_posts'] === '0' ? null : '1';
        $informComments = $_POST['inform_about_comments'] === '0' ? null : '1';

        do_action(
            'iac_save_user_settings',
            wp_get_current_user()->ID,
            $informPosts, # '1', '0' or NULL if the user didn't changed anything
            $informComments # '1', '0' or NULL if the user didn't changed anything
        );

        $user_settings = apply_filters('iac_get_user_settings', [], wp_get_current_user()->ID);

        echo sprintf(
            "%s // SET: %s // %s <br> IST: %s // %s",
            $informPosts,
            $informComments,
            $user_settings['inform_about_posts'],
            $user_settings['inform_about_comments']
        );

        wp_die(); // this is required to terminate immediately and return a proper response
    });
});

