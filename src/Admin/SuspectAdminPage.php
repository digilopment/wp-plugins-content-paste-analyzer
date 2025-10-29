<?php

namespace CPA\Admin;

use CPA\Core\Settings;

/**
 * Špecifická stránka: posledných 30 dní
 */
class SuspectAdminPage extends AdminPage
{
    public string $menu_title = 'Kontrola vloženého HTML obsahu';

    public string $page_title = 'Všetky články, ktoré majú v obsahu nesprávne použité HTML';

    public string $menu_slug = 'cpa-html-check';

    public string $description = 'Zoznam článkov, pri ktorých je zaznamenaný nesprávny obsah a je nutného ho upraviť.';

    protected array $query_args = [
        'date_query' => [
            [
                'after' => Settings::ARTICLE_DAYS_LIMIT . ' days ago',
            ],
            [
                'key' => Settings::CPA_DIRTY_HTML,
                'value' => '1',
            ],
        ],
    ];
}
