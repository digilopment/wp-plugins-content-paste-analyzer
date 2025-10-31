<?php

namespace Digilopment\Cpa\Tests;

use PHPUnit\Framework\TestCase;

class PhpCompatibilityTest extends TestCase
{
    private function runPhpCompatibilityCheck(string $version): int
    {
        $cmd = sprintf(
            '%s --standard=PHPCompatibility --extensions=php --runtime-set testVersion %s ./src/',
            escapeshellcmd(__DIR__ . '/../vendor/bin/phpcs'),
            escapeshellarg($version)
        );

        exec($cmd, $output, $returnVar);
        return $returnVar;
    }

    public function testPhpCompatibility80(): void
    {
        $returnCode = $this->runPhpCompatibilityCheck('8.0');
        $this->assertSame(0, $returnCode, 'PHPCompatibility check failed for PHP 8.0');
    }

    public function testPhpCompatibility81(): void
    {
        $returnCode = $this->runPhpCompatibilityCheck('8.1');
        $this->assertSame(0, $returnCode, 'PHPCompatibility check failed for PHP 8.1');
    }

    public function testPhpCompatibility82(): void
    {
        $returnCode = $this->runPhpCompatibilityCheck('8.2');
        $this->assertSame(0, $returnCode, 'PHPCompatibility check failed for PHP 8.2');
    }

    public function testPhpCompatibility83(): void
    {
        $returnCode = $this->runPhpCompatibilityCheck('8.3');
        $this->assertSame(0, $returnCode, 'PHPCompatibility check failed for PHP 8.3');
    }

    public function testPhpCompatibility84(): void
    {
        $returnCode = $this->runPhpCompatibilityCheck('8.4');
        $this->assertSame(0, $returnCode, 'PHPCompatibility check failed for PHP 8.4');
    }
}
