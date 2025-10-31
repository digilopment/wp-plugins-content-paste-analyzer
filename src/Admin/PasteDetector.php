<?php

namespace Digilopment\Cpa\Admin;

use Digilopment\Cpa\Core\Settings;
use function add_action;
use function admin_url;
use function check_ajax_referer;
use function current_user_can;
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
        add_action('admin_enqueue_scripts', [$this, 'enqueueScript']);
        add_action('wp_ajax_cpa_mark_paste', [$this, 'markPostDirty']);
    }

    public function enqueueScript(string $hook): void
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

        $postId = get_the_ID() ?: ($_GET['post'] ?? 0);

        wp_localize_script('cpa-paste-detector', 'cpaAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cpa_paste_detected'),
            'postId' => (int) $postId,
        ]);
    }

    public function markPostDirty(): void
    {
        check_ajax_referer('cpa_paste_detected', 'security');

        $postId = isset($_POST['post_id']) ? absint(wp_unslash($_POST['post_id'])) : false;
        if (!$postId) {
            wp_send_json_error('Invalid post ID');
        }

        if (!current_user_can('edit_post', $postId)) {
            wp_send_json_error('Insufficient permissions');
        }

        update_post_meta($postId, Settings::CPA_PASTED_HTML, 1);
        wp_send_json_success('Marked as dirty');
    }
}
