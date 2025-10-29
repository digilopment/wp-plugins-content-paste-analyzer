<?php

namespace CPA\Admin;

use CPA\Core\Settings;

class PasteAdminPage extends AdminPage
{
    public string $menu_title = 'Články so skopírovaným obsahom';

    public string $page_title = 'Všetky články, do ktorých bol skopírovaný čiastočný, alebo celý obsah.';

    public string $menu_slug = 'cpa-all-paste';

    public string $description = 'Zoznam článkov, pri ktorých bolo zaznamenané že pri vytváraní, alebo editovaní bol kopírovaný obsah. Skontrolujte a v prípade potreby upravte obsah článku.';

    protected array $query_args = [
        'posts_per_page' => Settings::POSTS_PER_PAGE,
        'meta_query' => [
            [
                'key' => Settings::CPA_PASTED_HTML,
                'value' => '1',
            ],
        ],
    ];
}
