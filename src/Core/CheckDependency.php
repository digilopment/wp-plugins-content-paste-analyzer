<?php

namespace Digilopment\Cpa\Core;

class CheckDependency
{
    public function register(): void
    {
        add_action('admin_init', [$this, 'checkDependencies']);
    }

    public function checkDependencies(): void
    {
        if (!is_plugin_active('classic-editor/classic-editor.php')) {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p><strong>Content Paste Analyzer:</strong> Vyžaduje sa <em>Classic Editor</em> plugin.</p></div>';
            });
        }
    }
}
