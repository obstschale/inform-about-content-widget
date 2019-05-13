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


if ( ! class_exists( 'IAC_Widget' ) ) {
    require_once __DIR__ . '/src/IAC_Widget.php';
}

add_action('widgets_init', function () {
    return register_widget("IAC_Widget");
});
