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

        $this->removeDirectory(beyond_modules_path());
    }

    private function removeDirectory(string $directory): void
    {
        if (! $handle = opendir($directory)) {
            return;
        }

        while (false !== $file = readdir($handle)) {
            if (! in_array($file, ['.', '..'], true)) {
                $path = $directory.'/'.$file;

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
}
