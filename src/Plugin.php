<?php

namespace CPA;

use CPA\Admin\AdminNotice;
use CPA\Admin\PasteAdminPage;
use CPA\Admin\PasteDetector;
use CPA\Admin\SuspectAdminPage;
use CPA\Core\ContentValidator;
use CPA\Core\Settings;
use WP_Post;
use function add_action;
use function is_plugin_active;
use function update_post_meta;
use function wp_is_post_revision;

class Plugin
{
    public function init(): void
    {
        (new AdminNotice())->register();
        (new PasteDetector())->register();
        (new PasteAdminPage())->register();
        (new SuspectAdminPage())->register();
        add_action('admin_init', [$this, 'check_dependencies']);
        add_action('save_post', [$this, 'validate_content'], 10, 2);
    }

    public function check_dependencies(): void
    {
        if (!is_plugin_active('classic-editor/classic-editor.php')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p><strong>Content Paste Analyzer:</strong> Vyžaduje sa <em>Classic Editor</em> plugin.</p></div>';
            });
        }
    }

    public function validate_content(int $post_id, WP_Post $post): void
    {
        if (wp_is_post_revision($post_id) || $post->post_type !== 'post') {
            return;
        }

        $validator = new ContentValidator($post->post_content);
        $has_issue = $validator->isValidArticle();

        if ($has_issue) {
            update_post_meta($post_id, Settings::CPA_DIRTY_HTML, 1);
        } else {
            update_post_meta($post_id, Settings::CPA_DIRTY_HTML, 0);
        }
    }
}
