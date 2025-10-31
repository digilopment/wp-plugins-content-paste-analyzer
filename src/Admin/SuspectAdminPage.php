<?php

namespace Digilopment\Cpa\Admin;

use Digilopment\Cpa\Core\Settings;

class SuspectAdminPage extends AdminPage
{
    public string $menuTitle = 'Kontrola vloženého HTML obsahu';

    public string $pageTitle = 'Všetky články, ktoré majú v obsahu nesprávne použité HTML';

    public string $menuSlug = 'cpa-html-check';

    public string $description = 'Zoznam článkov, pri ktorých je zaznamenaný nesprávny obsah a je nutné ho upraviť.';

    protected array $queryArgs = [
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
