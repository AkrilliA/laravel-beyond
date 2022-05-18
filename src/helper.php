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

    function beyond_copy_stub(string $stub, string $path, array $refactor = []): void {
        $action = new CopyAndRefactorFileAction(
            new CopyFileAction(),
            new RefactorFileAction()
        );

        $action->execute(
            beyond_path() . "/stubs/{$stub}",
            $path,
            $refactor
        );
    }

}

if (!function_exists('pluralize')) {

    function pluralize(string $singular): string {
        $lastLetter = substr($singular, strlen($singular) - 1);

        return match ($lastLetter) {
            'y' => substr($singular,0,-1).'ies',
            's' => $singular.'es',
            default => $singular.'s'
        };
    }

}
