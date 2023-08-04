<?php

namespace AkrilliA\LaravelBeyond\Actions;

use AkrilliA\LaravelBeyond\Exceptions\AlreadyExistsException;

class CopyAndRefactorFileAction
{
    public function __construct(
        protected CopyFileAction $copyFileAction,
        protected RefactorFileAction $refactorFileAction
    ) {
    }

    /**
     * @param  array<string, string>  $refactor
     *
     * @throws AlreadyExistsException
     */
    public function execute(string $sourcePath, string $targetPath, array $refactor = [], bool $force = false): void
    {
        $this->copyFileAction->execute($sourcePath, $targetPath, $force);

        if ($refactor) {
            $this->refactorFileAction->execute($targetPath, $refactor);
        }
    }
}
