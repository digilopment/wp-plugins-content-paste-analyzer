<?php

namespace Digilopment\Cpa\Admin;

use Digilopment\Cpa\Core\Settings;

class PasteAdminPage extends AdminPage
{
    public string $menuTitle = 'Články so skopírovaným obsahom';

    public string $pageTitle = 'Všetky články, do ktorých bol skopírovaný čiastočný, alebo celý obsah.';

    public string $menuSlug = 'cpa-all-paste';

    public string $description = 'Zoznam článkov, pri ktorých bolo zaznamenané, že pri vytváraní alebo editovaní bol kopírovaný obsah. Skontrolujte a v prípade potreby upravte obsah článku.';

    protected array $queryArgs = [
        'posts_per_page' => Settings::POSTS_PER_PAGE,
        'meta_query' => [
            [
                'key' => Settings::CPA_PASTED_HTML,
                'value' => '1',
            ],
        ],
    ];
}
