<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CreateDirectoryAction
{
    /**
     * @param  string|array<string>  $directory
     */
    public function execute(string|array $directory): void
    {
        if (is_array($directory)) {
            foreach ($directory as $dir) {
                $this->execute($dir);
            }

            return;
        }

        (new Filesystem())->ensureDirectoryExists(beyond_os_aware_path(base_path()."/modules/$directory"));
    }
}
