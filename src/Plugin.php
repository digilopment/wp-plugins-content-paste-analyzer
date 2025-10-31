<?php

namespace Digilopment\Cpa;

use Digilopment\Cpa\Admin\AdminNotice;
use Digilopment\Cpa\Admin\PasteAdminPage;
use Digilopment\Cpa\Admin\PasteDetector;
use Digilopment\Cpa\Admin\SuspectAdminPage;
use Digilopment\Cpa\Core\CheckDependency;
use Digilopment\Cpa\Core\SavePost;

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
