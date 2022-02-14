<?php

use Regnerisch\LaravelBeyond\Actions\MoveAndRefactorFileAction;
use Regnerisch\LaravelBeyond\Actions\MoveFileAction;
use Regnerisch\LaravelBeyond\Actions\RefactorFileAction;

if (!function_exists('beyond_path')) {

    function beyond_path(): string {
        return dirname(__DIR__);
    }

}

if (!function_exists('beyond_copy_stub')) {

    function beyond_copy_stub(string $stub, string $path, array $refactor = []): void {
        $action = new MoveAndRefactorFileAction(
            new MoveFileAction(),
            new RefactorFileAction()
        );

        $action->execute(
            beyond_path() . "/stubs/{$stub}",
            $path,
            $refactor
        );
    }

}
