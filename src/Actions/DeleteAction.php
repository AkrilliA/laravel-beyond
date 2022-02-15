<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeleteAction
{
    public function execute(string $path, bool $file = false)
    {
        $fs = new Filesystem();

        if ($file) {
            $fs->delete($path);
        } else {
            $fs->deleteDirectory($path);
        }
    }
}
