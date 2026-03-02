<?php
if (!defined('ABSPATH')) exit;

class P1_GitHub_Updater {

    private $owner;
    private $repo;
    private $plugin_file;
    private $plugin_slug;

    public function __construct($args) {
        $this->owner = $args['owner'];
        $this->repo = $args['repo'];
        $this->plugin_file = $args['plugin_file'];
        $this->plugin_slug = $args['plugin_slug'];

        add_filter('pre_set_site_transient_update_plugins', [$this, 'check_update']);
    }

    public function check_update($transient) {
        if (empty($transient->checked)) return $transient;

        $current_version = $transient->checked[plugin_basename($this->plugin_file)];
        $response = wp_remote_get("https://api.github.com/repos/{$this->owner}/{$this->repo}/releases/latest", [
            'headers' => ['User-Agent' => $this->repo]
        ]);

        if (is_wp_error($response)) return $transient;

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (!isset($body['tag_name'])) return $transient;

        $remote_version = ltrim($body['tag_name'], 'v');

        if (version_compare($remote_version, $current_version, '>')) {
            $transient->response[plugin_basename($this->plugin_file)] = (object) [
                'slug' => $this->plugin_slug,
                'new_version' => $remote_version,
                'package' => $body['assets'][0]['browser_download_url'] ?? ''
            ];
        }

        return $transient;
    }
}
