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
    private AdminNotice $adminNotice;

    private PasteDetector $pasteDetector;

    private PasteAdminPage $pasteAdminPage;

    private SuspectAdminPage $suspectAdminPage;

    private CheckDependency $checkDependency;

    private SavePost $savePost;

    public function __construct()
    {
        $this->adminNotice = new AdminNotice();
        $this->pasteDetector = new PasteDetector();
        $this->pasteAdminPage = new PasteAdminPage();
        $this->suspectAdminPage = new SuspectAdminPage();
        $this->checkDependency = new CheckDependency();
        $this->savePost = new SavePost();
    }

    public function init(): void
    {
        $this->adminNotice->register();
        $this->pasteDetector->register();
        $this->pasteAdminPage->register();
        $this->suspectAdminPage->register();
        $this->checkDependency->register();
        $this->savePost->register();
    }
}
