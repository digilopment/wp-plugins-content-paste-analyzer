<?php

namespace Digilopment\Cpa\Tests;

use Digilopment\Cpa\Core\ContentValidator;
use PHPUnit\Framework\TestCase;

class ContentValidatorTest extends TestCase
{
    private const ARTICLES_DIR = __DIR__ . '/articles';
    private const PREFIX_BAD = 'bad-';

    public function testAllHtmlFiles(): void
    {
        $filePaths = glob(self::ARTICLES_DIR . '/*.html') ?: [];

        foreach ($filePaths as $filePath) {
            $fileName = basename($filePath);
            $htmlContent = file_get_contents($filePath) ?: '';
            $validator = new ContentValidator($htmlContent);

            $expectedResult = str_starts_with($fileName, self::PREFIX_BAD);

            $this->assertSame(
                $expectedResult,
                $validator->isValidArticle(),
                sprintf(
                    'File %s failed validation. Expected: %s',
                    $fileName,
                    $expectedResult ? 'TRUE (Dirty)' : 'FALSE (Clean)'
                )
            );
        }
    }
}
