<?php
/**
 * Plugin Name: Content Paste Analyzer
 * Description: Detects and flags problematic HTML pasted into WordPress posts.
 * Version: 1.0.0
 * Author: Tomas Doubek
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use CPA\Plugin;

add_action('plugins_loaded', function () {
    (new Plugin())->init();
});
