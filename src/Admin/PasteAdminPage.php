<?php

namespace CPA\Admin;

use CPA\Core\Settings;

class PasteAdminPage extends AdminPage
{
    public string $menu_title = 'Všetky paste články';

    public string $page_title = 'Všetky články, do ktorých bol pastnutý content';

    public string $menu_slug = 'cpa-all-paste';

    public string $description = 'Zoznam príspevkov, pri ktorých bol zaznamenaný paste. Skontrolujte a v prípade potreby upravte obsah.';

    protected array $query_args = [
        'posts_per_page' => 500,
        'meta_query' => [
            [
                'key' => Settings::CPA_PASTED_HTML,
                'value' => '1',
            ],
        ],
    ];
}
