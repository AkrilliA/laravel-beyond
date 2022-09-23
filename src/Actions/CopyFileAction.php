<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Regnerisch\LaravelBeyond\Exceptions\FileAlreadyExistsException;

class CopyFileAction
{
    public function execute(string $srcPath, string $targetPath, bool $force = false)
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
        );

        if (!$force && $fs->exists($targetPath)) {
            throw new FileAlreadyExistsException('File already exists. You could use --force to create a new file.');
        }

        $fs->copy(
            $srcPath,
            $targetPath,
        );
    }
}
