<?php

namespace Regnerisch\LaravelBeyond\Actions;

class MoveAndRefactorFileAction
{
    public function __construct(
        protected MoveFileAction $moveFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, array $refactor = []): void
    {
        $this->moveFileAction->execute($sourcePath, $targetPath);
        $this->refactorFileAction->execute($targetPath, $refactor);
    }
}
