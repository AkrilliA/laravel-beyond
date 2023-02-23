<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CreateDirectoryAction
{
    public function execute(string|array $directory): void
    {
        if (is_array($directory)) {
            foreach ($directory as $dir) {
                $this->execute($dir);
            }

            return;
        }

        (new Filesystem())->ensureDirectoryExists(base_path()."/modules/$directory");
    }
}
