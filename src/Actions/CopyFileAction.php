<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CopyFileAction
{
    public function execute(string $srcPath, string $targetPath)
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
            0755,
            true
        );

        $fs->move(
            $srcPath,
            $targetPath,
        );
    }
}
