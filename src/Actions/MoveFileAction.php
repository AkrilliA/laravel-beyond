<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class MoveFileAction
{
    public function execute(string $srcPath, string $targetPath, array $refactor = [])
    {
        $fs = new Filesystem();
        $fs->copy(
            $srcPath,
            $targetPath,
        );

        file_put_contents(
            $targetPath,
            str_replace(
                array_keys($refactor),
                $refactor,
                file_get_contents($targetPath)
            )
        );
    }
}
