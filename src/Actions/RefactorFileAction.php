<?php

namespace Regnerisch\LaravelBeyond\Actions;

class RefactorFileAction
{
    public function execute(string $path, array $refactor = []): void
    {
        if (!$refactor) {
            return;
        }

        file_put_contents(
            $path,
            str_replace(
                array_keys($refactor),
                $refactor,
                file_get_contents($path)
            )
        );
    }
}
