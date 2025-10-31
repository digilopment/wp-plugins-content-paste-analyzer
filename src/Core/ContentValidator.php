<?php

namespace Digilopment\Cpa\Core;

class ContentValidator
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function isValidArticle(): bool
    {
        $trimmedContent = trim($this->content);
        if (empty($trimmedContent)) {
            return false;
        }

        // Hľadá tag na začiatku (napr. <div>) a zodpovedajúci uzatvárací tag
        // na konci obsahu, ktorý neobsahuje žiadne iné textové uzávery.
        // Používame modifikátor 's' (DOTALL), aby bodka (.) zahrnula aj nové riadky.
        $pattern = '/^\s*<([a-z][a-z0-9]*)\b[^>]*>(.+?)<\/\1>\s*$/is';
        if (preg_match($pattern, $trimmedContent, $matches)) {
            $openingTag = strtolower($matches[1]);

            if (in_array($openingTag, Settings::IGNORED_TAGS, true)) {
                return false;
            }

            return true;
        }

        return false;
    }
}
