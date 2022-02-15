<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class DeleteAppFolderAction
{
    public function execute()
    {
        $fs = new Filesystem();

        $fs->deleteDirectory(base_path() . 'app');
    }
}
