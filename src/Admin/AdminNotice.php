<?php

namespace CPA\Admin;

use CPA\Core\Settings;
use function add_action;
use function current_user_can;
use function get_post;
use function get_post_meta;
use function is_user_logged_in;

class AdminNotice
{
    public function register(): void
    {
        // Admin notifikácie
        add_action('admin_notices', [$this, 'show_admin_notice']);

        // Frontend notifikácie
        add_action('wp_body_open', [$this, 'show_frontend_notice']); // zobrazí sa hneď po <body>
    }

    public function show_admin_notice(): void
    {
        $screen = get_current_screen();
        if (!$screen || $screen->base !== 'post' || $screen->post_type !== 'post') {
            return;
        }

        global $post;
        if (!$post) {
            return;
        }

        $this->render_notice($post->ID, false);
    }

    public function show_frontend_notice(): void
    {
        if (!is_user_logged_in() || !current_user_can('edit_posts')) {
            return;
        }

        if (!is_singular('post')) {
            return;
        }

        $post = get_post();
        if (!$post) {
            return;
        }

        $this->render_notice($post->ID, true);
    }

    private function render_notice(int $post_id, bool $frontend = false): void
    {
        $dirty = get_post_meta($post_id, Settings::CPA_DIRTY_HTML, true);

        if (!$dirty) {
            return;
        }

        if ($frontend) {
            $template_path = __DIR__ . '/templates/admin-notice-frontend.php';
        } else {
            $template_path = __DIR__ . '/templates/admin-notice.php';
        }

        if (file_exists($template_path)) {
            include $template_path;
        }
    }
}
