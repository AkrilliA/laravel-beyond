<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeleteAction
{
    public function execute(string $path)
    {
        $fs = new Filesystem();

        if ($fs->isFile($path)) {
            $fs->delete($path);
        } else {
            $fs->deleteDirectory($path);
        }
    }
}
