<?php
if (!defined('ABSPATH')) exit;

class P1_Plugin {

    private static $instance = null;

    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'init']);
    }

    public function init() {
        // Your plugin logic here
    }
}
