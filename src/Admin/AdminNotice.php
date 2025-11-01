<?php

namespace Digilopment\Cpa\Admin;

use Digilopment\Cpa\Core\Settings;
use function add_action;
use function current_user_can;
use function get_post;
use function get_post_meta;
use function is_user_logged_in;

class AdminNotice
{
    public function register(): void
    {
        add_action('admin_notices', [$this, 'showAdminNotice']);
        add_action('wp_body_open', [$this, 'showFrontendNotice']);
    }

    public function showAdminNotice(): void
    {
        $screen = get_current_screen();
        if (!$screen || $screen->base !== 'post' || $screen->post_type !== 'post') {
            return;
        }

        global $post;
        if (!$post) {
            return;
        }

        $this->renderNotice($post->ID, false);
    }

    public function showFrontendNotice(): void
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

        $this->renderNotice($post->ID, true);
    }

    private function renderNotice(int $postId, bool $frontend = false): void
    {
        $isDirty = get_post_meta($postId, Settings::CPA_DIRTY_HTML, true);
        if (!$isDirty) {
            return;
        }
        $templatePath = $frontend
            ? __DIR__ . '/templates/admin-notice-frontend.php'
            : __DIR__ . '/templates/admin-notice.php';
        
        
        if (file_exists($templatePath)) {
            include $templatePath;
        }
    }
}
