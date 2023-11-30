<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CreateDirectoryAction
{
    public function __construct(
        private readonly NormalizePathAction $normalizePathAction
    ) {
    }

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

        (new Filesystem())->ensureDirectoryExists(
            $this->normalizePathAction->execute(base_path('modules/'.$directory))
        );
    }
}
