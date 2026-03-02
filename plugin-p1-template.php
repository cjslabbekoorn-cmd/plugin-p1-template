<?php
/**
 * Plugin Name: P1_PLUGIN_NAME
 * Description: P1_PLUGIN_DESCRIPTION
 * Version: 1.0.0
 * Author: C.J. Slabbekoorn | Positie1
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Text Domain: P1_PLUGIN_SLUG
 */

if (!defined('ABSPATH')) exit;

define('P1_VERSION', '1.0.0');
define('P1_PLUGIN_SLUG', 'P1_PLUGIN_SLUG');
define('P1_GH_OWNER', 'cjslabbekoorn-cmd');
define('P1_GH_REPO', 'P1_GH_REPO');

require_once __DIR__ . '/includes/requirements.php';
require_once __DIR__ . '/includes/class-plugin.php';
require_once __DIR__ . '/includes/class-github-updater.php';

register_activation_hook(__FILE__, 'p1_activation_check');
add_action('plugins_loaded', 'p1_requirements_bootstrap', 1);

add_action('plugins_loaded', function () {
    new P1_GitHub_Updater([
        'owner' => P1_GH_OWNER,
        'repo'  => P1_GH_REPO,
        'plugin_file' => __FILE__,
        'plugin_slug' => P1_PLUGIN_SLUG,
    ]);
}, 2);

add_action('plugins_loaded', function () {
    P1_Plugin::instance();
}, 20);
