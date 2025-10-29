<?php

namespace CPA\Tests;

use CPA\Core\ContentValidator;
use PHPUnit\Framework\TestCase;

class ContentValidatorTest extends TestCase
{

    private const ARTICLES_DIR = __DIR__ . '/articles';
    private const PREFIX_OK = 'ok-';
    private const PREFIX_BAD = 'bad-';

    public function testAllHtmlFiles(): void
    {
        $files = glob(self::ARTICLES_DIR . '/*.html');

        foreach ($files as $filePath) {
            $fileName = basename($filePath);
            $html = file_get_contents($filePath);
            $validator = new ContentValidator($html, $fileName);
            $expectedResult = str_starts_with($fileName, self::PREFIX_BAD);

            $this->assertSame(
                $expectedResult,
                $validator->isValidArticle(),
                "File {$fileName} failed validation. Expected: " . ($expectedResult ? 'TRUE (Dirty)' : 'FALSE (Clean)')
            );
        }
    }
}
