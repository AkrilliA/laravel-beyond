<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class FetchDirectoryNamesFromPathAction
{
    public function execute(string $path): array
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists($path);

        $directories = array_map(
            function ($directory) {
                return last(explode('/', $directory));
            },
            $fs->directories($path)
        );

        return $directories;
    }
}
