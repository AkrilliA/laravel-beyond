<?php

namespace AkrilliA\LaravelBeyond\Actions;

use AkrilliA\LaravelBeyond\Exceptions\AlreadyExistsException;
use Illuminate\Filesystem\Filesystem;

class CopyFileAction
{
    public function __construct(
        private readonly NormalizePathAction $normalizePathAction
    ) {
    }

    public function execute(string $srcPath, string $targetPath, bool $force = false): void
    {
        [$srcPath, $targetPath] = $this->normalizePathAction->execute([
            $srcPath,
            $targetPath,
        ]);

        $fs = new Filesystem();

        $fs->ensureDirectoryExists(
            dirname($targetPath),
        );

        if (! $force && $fs->exists($targetPath)) {
            throw new AlreadyExistsException('File already exists. You could use --force to create a new file.');
        }

        $fs->copy(
            $srcPath,
            $targetPath,
        );
    }
}
