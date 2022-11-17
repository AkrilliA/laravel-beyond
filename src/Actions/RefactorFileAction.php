<?php

namespace AkrilliA\LaravelBeyond\Actions;

class RefactorFileAction
{
    public function execute(string $path, array $refactor): void
    {
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
