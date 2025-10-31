<?php

namespace Digilopment\Cpa\Core;

use WP_Post;
use function add_action;
use function update_post_meta;
use function wp_is_post_revision;

class SavePost
{
    public function register(): void
    {
        add_action('save_post', [$this, 'validateContent'], 10, 2);
    }

    public function validateContent(int $postId, WP_Post $post): void
    {
        if (wp_is_post_revision($postId) || $post->post_type !== 'post') {
            return;
        }

        $validator = new ContentValidator($post->post_content);
        $hasIssue = $validator->isValidArticle();

        if ($hasIssue) {
            update_post_meta($postId, Settings::CPA_DIRTY_HTML, 1);
        } else {
            update_post_meta($postId, Settings::CPA_DIRTY_HTML, 0);
        }
    }
}
