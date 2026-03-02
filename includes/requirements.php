<?php
if (!defined('ABSPATH')) exit;

function p1_activation_check() {
    if (version_compare(PHP_VERSION, '7.4', '<')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('Plugin requires PHP 7.4 or higher.');
    }
}

function p1_requirements_bootstrap() {
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>This plugin requires Elementor.</p></div>';
        });
    }
}
