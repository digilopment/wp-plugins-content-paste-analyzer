<?php

namespace CPA\Admin;

use CPA\Core\Settings;
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
use function wp_reset_postdata;

class AdminPage
{
    public string $menu_title = '';

    public string $page_title = '';

    public string $menu_slug = '';

    public string $description = '';

    /** @var array<string, mixed> */
    protected array $query_args = [];

    public function __construct()
    {
        $this->register();
    }

    public function register(): void
    {
        add_action('admin_menu', [$this, 'register_page']);
    }

    public function register_page(): void
    {
        add_submenu_page(
            'tools.php',
            $this->page_title,
            $this->menu_title,
            'edit_others_posts',
            $this->menu_slug,
            [$this, 'tools_page_render']
        );
    }

    public function tools_page_render(): void
    {
        $user = wp_get_current_user();

        if (!array_intersect(Settings::ARTICLE_TOOLS_VISIBLE_FOR_ROLES, $user->roles)) {
            wp_die('Unauthorized');
        }

        $args = array_merge([
            'post_type' => 'post',
            'posts_per_page' => 200,
            'meta_query' => [
                [
                    'key' => Settings::CPA_DIRTY_HTML,
                    'value' => '1',
                ],
            ],
            'orderby' => 'date',
            'order' => 'DESC',
            ], $this->query_args);

        $query = new WP_Query($args);

        $posts_data = [];
        while ($query->have_posts()) {
            $query->the_post();
            $pid = (int) get_the_ID();
            $posts_data[] = [
                'title' => get_the_title($pid),
                'author' => get_the_author_meta('display_name', (int) get_post_field('post_author', $pid)),
                'date' => get_the_date('', $pid),
                'status' => get_post_status($pid),
                'edit_link' => get_edit_post_link($pid),
                'view_link' => get_permalink($pid),
            ];
        }
        wp_reset_postdata();

        $template_path = __DIR__ . '/templates/admin-page.php';
        if (file_exists($template_path)) {
            include $template_path;
        }
    }
}
