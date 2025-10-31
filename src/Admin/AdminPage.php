<?php

namespace Digilopment\Cpa\Admin;

use Digilopment\Cpa\Core\Settings;
use WP_Query;
use function add_action;
use function add_submenu_page;
use function get_edit_post_link;
use function get_permalink;
use function get_post_field;
use function get_post_status;
use function get_the_author_meta;
use function get_the_date;
use function get_the_ID;
use function get_the_title;
use function wp_die;
use function wp_get_current_user;
use function wp_reset_postdata;

class AdminPage
{
    public string $menuTitle = '';

    public string $pageTitle = '';

    public string $menuSlug = '';

    public string $description = '';

    /** @var array<string, mixed> */
    protected array $queryArgs = [];

    public function __construct()
    {
        $this->register();
    }

    public function register(): void
    {
        add_action('admin_menu', [$this, 'registerPage']);
    }

    public function registerPage(): void
    {
        add_submenu_page(
            'tools.php',
            $this->pageTitle,
            $this->menuTitle,
            'edit_others_posts',
            $this->menuSlug,
            [$this, 'toolsPageRender']
        );
    }

    public function toolsPageRender(): void
    {
        $user = wp_get_current_user();

        if (!array_intersect(Settings::ARTICLE_TOOLS_VISIBLE_FOR_ROLES, $user->roles)) {
            wp_die('Unauthorized');
        }

        $args = array_merge([
            'post_type' => 'post',
            'posts_per_page' => Settings::POSTS_PER_PAGE,
            'meta_query' => [
                [
                    'key' => Settings::CPA_DIRTY_HTML,
                    'value' => '1',
                ],
            ],
            'orderby' => 'date',
            'order' => 'DESC',
        ], $this->queryArgs);

        $query = new WP_Query($args);

        $postsData = [];
        while ($query->have_posts()) {
            $query->the_post();
            $postId = (int) get_the_ID();
            $postsData[] = [
                'title' => get_the_title($postId),
                'author' => get_the_author_meta('display_name', (int) get_post_field('post_author', $postId)),
                'date' => get_the_date('', $postId),
                'status' => get_post_status($postId),
                'editLink' => get_edit_post_link($postId),
                'viewLink' => get_permalink($postId),
            ];
        }
        wp_reset_postdata();

        $templatePath = __DIR__ . '/templates/admin-page.php';
        if (file_exists($templatePath)) {
            include $templatePath;
        }
    }
}
