<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Regnerisch\LaravelBeyond\Exceptions\FileAlreadyExistsException;

class CopyFileAction
{
    public function execute(string $srcPath, string $targetPath, bool $overwrite = false)
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
        );

        if (!$overwrite && $fs->exists($targetPath)) {
            throw new FileAlreadyExistsException();
        }

        $fs->copy(
            $srcPath,
            $targetPath,
        );
    }
}
