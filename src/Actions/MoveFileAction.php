<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class MoveFileAction
{
    public function execute(string $sourcePath, string $targetPath, bool $force = false): void
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists(dirname($targetPath));

        if (! $force && $fs->exists($targetPath)) {
            throw new \Exception('File already exists'); // TODO: Custom Exception
        }

        $fs->move(
            $sourcePath,
            $targetPath
        );
    }
}
