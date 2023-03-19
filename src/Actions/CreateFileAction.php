<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

class CreateFileAction
{
    public function execute(string|array $file): void
    {
        $fs = new Filesystem();
        $files = Arr::wrap($file);

        foreach ($files as $file => $contents) {
            if (is_int($file)) {
                $file = $contents;
                $contents = '';
            }

            $fs->ensureDirectoryExists(dirname($file));

            $fs->put($file, $contents);
        }
    }
}
