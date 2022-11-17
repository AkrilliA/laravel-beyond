<?php

namespace AkrilliA\LaravelBeyond\Actions;

class CopyAndRefactorFileAction
{
    public function __construct(
        protected CopyFileAction $copyFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $force = false): void
    {
        $this->copyFileAction->execute($sourcePath, $targetPath, $force);

        if ($refactor) {
            $this->refactorFileAction->execute($targetPath, $refactor);
        }
    }
}
