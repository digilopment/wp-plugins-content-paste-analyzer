<?php

namespace Digilopment\Cpa\Tests;

use Digilopment\Cpa\Core\ContentValidator;
use PHPUnit\Framework\TestCase;

class ContentValidatorTest extends TestCase
{
    private const ARTICLES_DIR = __DIR__ . '/articles';
    private const PREFIX_BAD = 'bad-';

    /**
     * @dataProvider htmlFilesProvider
     */
    public function testHtmlFile(string $filePath): void
    {
        $fileName = basename($filePath);
        $htmlContent = file_get_contents($filePath) ?: '';
        $validator = new ContentValidator($htmlContent);

        $expectedResult = strpos($fileName, self::PREFIX_BAD) === 0;

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
     * @return array<int, array{0: string}>
     */
    public static function htmlFilesProvider(): array
    {
        $filePaths = glob(self::ARTICLES_DIR . '/*.html') ?: [];
        return array_map(static fn($filePath) => [$filePath], $filePaths);
    }
}
