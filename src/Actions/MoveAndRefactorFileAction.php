<?php

namespace AkrilliA\LaravelBeyond\Actions;

class MoveAndRefactorFileAction
{
    public function __construct(
        protected MoveFileAction $moveFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    /**
     * @param  array<string, string>  $refactor
     */
    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $force = false): void
    {
        $this->moveFileAction->execute($sourcePath, $targetPath, $force);

        if ($refactor) {
            $this->refactorFileAction->execute($targetPath, $refactor);
        }
    }
}
