<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeleteFolderAction
{
    public function execute(string $path)
    {
        $fs = new Filesystem();

        $fs->deleteDirectory(base_path() . $path);
    }
}
