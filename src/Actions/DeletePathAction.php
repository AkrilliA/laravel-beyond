<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeletePathAction
{
    public function execute(string $path): void
    {
        $fs = new Filesystem();

        if ($fs->isDirectory($path)) {
            $fs->deleteDirectory($path);
        } else {
            $fs->delete($path);
        }
    }
}
