<?php

namespace CPA\Admin;

use CPA\Core\ArticleMeta;

/**
 * Špecifická stránka: posledných 30 dní
 */
class SuspectAdminPage extends AdminPage
{
    public string $menu_title = 'Nutná kontrola článkov';

    public string $page_title = 'Všetky články, ktoré majú nesprávny HTML content';

    public string $menu_slug = 'cpa-html-check';

    public string $description = 'Zoznam článkov, pri ktorých je zaznamenaný nesprávny obsah a je nutného ho upraviť.';

    protected array $query_args = [
        'date_query' => [
            [
                'after' => '30 days ago',
            ],
            [
                'key' => ArticleMeta::CPA_DIRTY_HTML,
                'value' => '1',
            ],
        ],
    ];
}
