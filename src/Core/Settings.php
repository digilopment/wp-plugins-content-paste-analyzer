<?php

namespace Digilopment\Cpa\Core;

class Settings
{
    public const CPA_DIRTY_HTML = '_cpa_dirty_html';
    public const CPA_PASTED_HTML = '_cpa_pasted_html';
    public const ARTICLE_TOOLS_VISIBLE_FOR_ROLES = ['administrator', 'chief_editor'];
    public const IGNORED_TAGS = ['blockquote', 'figure', 'pre', 'p'];
    public const POSTS_PER_PAGE = 200;
    public const ARTICLE_DAYS_LIMIT = 30;
}
