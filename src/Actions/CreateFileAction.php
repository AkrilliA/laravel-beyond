<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

class CreateFileAction
{
    public function __construct(
        private readonly NormalizePathAction $normalizePathAction
    ) {
    }

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

            $file = $this->normalizePathAction->execute($file);

            $fs->ensureDirectoryExists(dirname($file));

            $fs->put($file, $contents);
        }
    }
}
