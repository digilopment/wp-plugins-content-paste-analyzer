<?php

namespace CPA;

use CPA\Admin\AdminNotice;
use CPA\Admin\PasteAdminPage;
use CPA\Admin\PasteDetector;
use CPA\Admin\SuspectAdminPage;
use CPA\Core\CheckDependency;
use CPA\Core\SavePost;

class Plugin
{
    public function init(): void
    {
        (new AdminNotice())->register();
        (new PasteDetector())->register();
        (new PasteAdminPage())->register();
        (new SuspectAdminPage())->register();
        (new CheckDependency())->register();
        (new SavePost())->register();
    }
}
