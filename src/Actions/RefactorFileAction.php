<?php

namespace AkrilliA\LaravelBeyond\Actions;

class RefactorFileAction
{
    /**
     * @param  array<string, string>  $refactor
     */
    public function execute(string $path, array $refactor): void
    {
        if (! $contents = file_get_contents($path)) {
            return;
        }

        file_put_contents(
            $path,
            str_replace(
                array_keys($refactor),
                $refactor,
                $contents
            )
        );
    }
}
