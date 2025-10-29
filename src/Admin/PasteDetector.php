<?php

namespace CPA\Admin;

use CPA\Core\ArticleMeta;
use function add_action;
use function admin_url;
use function check_ajax_referer;
use function get_the_ID;
use function plugin_dir_url;
use function update_post_meta;
use function wp_create_nonce;
use function wp_enqueue_script;
use function wp_localize_script;
use function wp_send_json_error;
use function wp_send_json_success;

class PasteDetector
{
    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue_script']);
        add_action('wp_ajax_cpa_mark_paste', [$this, 'mark_post_dirty']);
    }

    public function enqueue_script(string $hook): void
    {
        if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
            return;
        }

        wp_enqueue_script(
            'cpa-paste-detector',
            plugin_dir_url(__DIR__) . '/../../assets/js/paste-detector.js',
            ['jquery'],
            '1.0',
            true
        );

        $post_id = get_the_ID() ?: ($_GET['post'] ?? 0);

        wp_localize_script('cpa-paste-detector', 'cpaAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cpa_paste_detected'),
            'postId' => (int) $post_id,
        ]);
    }

    public function mark_post_dirty(): void
    {
        check_ajax_referer('cpa_paste_detected', 'security');

        $post_id = intval($_POST['post_id'] ?? 0);
        if (!$post_id) {
            wp_send_json_error('Invalid post ID');
        }

        update_post_meta($post_id, ArticleMeta::CPA_PASTED_HTML, 1);
        wp_send_json_success('Marked as dirty');
    }
}
