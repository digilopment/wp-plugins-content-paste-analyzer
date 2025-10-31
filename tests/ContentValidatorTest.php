<?php

namespace Digilopment\Cpa\Tests;

use Digilopment\Cpa\Core\ContentValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ContentValidatorTest extends TestCase
{

    private const ARTICLES_DIR = __DIR__ . '/articles';
    private const PREFIX_BAD = 'bad-';

    #[DataProvider('htmlFilesProvider')]
    public function testHtmlFile(string $filePath): void
    {
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

    /**
     * @return array<int, array<string>>
     */
    public static function htmlFilesProvider(): array
    {
        $filePaths = glob(self::ARTICLES_DIR . '/*.html') ?: [];

        return array_map(fn($filePath) => [$filePath], $filePaths);
    }
}
