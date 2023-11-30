<?php

namespace AkrilliA\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CopyAndRefactorDirectoryAction
{
    public function __construct(
        protected CopyAndRefactorFileAction $copyAndRefactorFileAction,
    ) {
    }

    /**
     * @param  array<string, string>  $refactor
     */
    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $force = false): void
    {
        $fs = new Filesystem();
        $files = $fs->files($sourcePath);

        foreach ($files as $file) {
            $this->copyAndRefactorFileAction->execute(
                beyond_os_aware_path($sourcePath.'/'.$file->getFilename()),
                beyond_os_aware_path($targetPath.'/'.$file->getFilename()),
                $refactor,
                $force
            );
        }
    }
}
