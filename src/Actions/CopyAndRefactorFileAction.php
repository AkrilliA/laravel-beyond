<?php

namespace Regnerisch\LaravelBeyond\Actions;

class CopyAndRefactorFileAction
{
    public function __construct(
        protected CopyFileAction $copyFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $overwrite = false): void
    {
        $this->copyFileAction->execute($sourcePath, $targetPath, $overwrite);

        if ($refactor) {
            $this->refactorFileAction->execute($targetPath, $refactor);
        }
    }
}
