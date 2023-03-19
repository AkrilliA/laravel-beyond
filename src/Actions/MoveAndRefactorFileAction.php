<?php

namespace AkrilliA\LaravelBeyond\Actions;

class MoveAndRefactorFileAction
{
    public function __construct(
        protected MoveFileAction $moveFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $force = false): void
    {
        try {
            $this->moveFileAction->execute($sourcePath, $targetPath, $force);
        } catch (\Exception $e) {
            dd($sourcePath, $targetPath);
        }

        if ($refactor) {
            $this->refactorFileAction->execute($targetPath, $refactor);
        }
    }
}
