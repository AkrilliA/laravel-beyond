<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

class CreateFileAction
{
    /**
     * @param  string|array<int, string>|array<string, string>  $files
     */
    public function execute(string|array $files): void
    {
        $fs = new Filesystem();
        $files = Arr::wrap($files);

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
