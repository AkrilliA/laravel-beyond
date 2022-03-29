<?php

namespace Regnerisch\LaravelBeyond\Actions;

use Illuminate\Filesystem\Filesystem;

class CopyAndRefactorDirectoryAction
{
    public function __construct(
        protected CopyAndRefactorFileAction $copyAndRefactorFileAction,
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, array $refactor = []): void
    {
        $fs = new Filesystem();
        $files = $fs->files($sourcePath);

        foreach ($files as $file) {
            $this->copyAndRefactorFileAction->execute(
                $sourcePath . DIRECTORY_SEPARATOR . $file->getFilename(),
                $targetPath . DIRECTORY_SEPARATOR . $file->getFilename(),
                $refactor
            );
        }
    }
}
