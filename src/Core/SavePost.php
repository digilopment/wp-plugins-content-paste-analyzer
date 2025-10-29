<?php

namespace CPA\Core;

use WP_Post;
use function add_action;
use function update_post_meta;
use function wp_is_post_revision;

class SavePost
{
    public function register(): void
    {
        add_action('save_post', [$this, 'validate_content'], 10, 2);
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
