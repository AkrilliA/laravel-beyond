<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeletePathAction
{
    public function __construct(
        private readonly NormalizePathAction $normalizePathAction
    ) {
    }

    public function execute(string $path): void
    {
        $path = $this->normalizePathAction->execute($path);

        $fs = new Filesystem();

        if ($fs->isDirectory($path)) {
            $fs->deleteDirectory($path);
        } else {
            $fs->delete($path);
        }
    }
}
