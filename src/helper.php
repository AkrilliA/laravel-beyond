<?php

use Regnerisch\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use Regnerisch\LaravelBeyond\Actions\CopyFileAction;
use Regnerisch\LaravelBeyond\Actions\RefactorFileAction;

if (!function_exists('beyond_path')) {

    function beyond_path(): string {
        return dirname(__DIR__);
    }

}

if (!function_exists('beyond_copy_stub')) {

    function beyond_copy_stub(string $stub, string $path, array $refactor = [], bool $overwrite = false): void {
        $action = new CopyAndRefactorFileAction(
            new CopyFileAction(),
            new RefactorFileAction()
        );

        $action->execute(
            beyond_path() . "/stubs/{$stub}",
            $path,
            $refactor,
            $overwrite
        );
    }

}
