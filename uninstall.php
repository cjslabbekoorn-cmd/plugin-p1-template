<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

$leave = get_option('p1_leave_data', 'yes');

if ($leave !== 'yes') {
    delete_option('p1_settings');
    delete_option('p1_leave_data');
}
