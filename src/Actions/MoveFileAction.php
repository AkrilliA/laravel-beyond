<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class MoveFileAction
{
    public function __construct(
        private readonly NormalizePathAction $normalizePathAction
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, bool $force = false): void
    {
        [$sourcePath, $targetPath] = $this->normalizePathAction->execute([
            $sourcePath,
            $targetPath,
        ]);

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
