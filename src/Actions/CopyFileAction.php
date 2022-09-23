<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Regnerisch\LaravelBeyond\Exceptions\AlreadyExistsException;

class CopyFileAction
{
    public function execute(string $srcPath, string $targetPath, bool $overwrite = false)
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
        );

        if (!$overwrite && $fs->exists($targetPath)) {
            throw new AlreadyExistsException('File already exists. You could use --overwrite to create a new file.');
        }

        $fs->copy(
            $srcPath,
            $targetPath,
        );
    }
}
