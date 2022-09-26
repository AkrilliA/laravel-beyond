<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CopyFileAction
{
    public function execute(string $srcPath, string $targetPath, bool $force = false)
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
        );

        if (! $force && $fs->exists($targetPath)) {
            return;
        }

        $fs->copy(
            $srcPath,
            $targetPath,
        );
    }
}
