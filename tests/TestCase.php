<?php

namespace Tests;

use AkrilliA\LaravelBeyond\LaravelBeyondServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelBeyondServiceProvider::class,
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeDirectory(beyond_path());
    }

    private function removeDirectory(string $directory): void
    {
        if (! is_dir($directory)) {
            return;
        }

        if (! $handle = opendir($directory)) {
            return;
        }

        while (false !== $file = readdir($handle)) {
            if (! in_array($file, ['.', '..'], true)) {
                $path = $directory.DIRECTORY_SEPARATOR.$file;

                if (is_dir($path)) {
                    $this->removeDirectory($path);
                } else {
                    unlink($path);
                }
            }
        }

        closedir($handle);
        rmdir($directory);
    }

    protected function assertNamespace(string $namespace, string $contents): void
    {
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringContainsString("namespace {$namespace};", $contents);
    }

    protected function assertClassName(string $className, string $contents): void
    {
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString("class {$className}", $contents);
    }
}
