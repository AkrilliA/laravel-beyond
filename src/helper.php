<?php

use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use AkrilliA\LaravelBeyond\Actions\CopyFileAction;
use AkrilliA\LaravelBeyond\Actions\RefactorFileAction;
use Illuminate\Support\Facades\Artisan;

if (!function_exists('beyond_path')) {
    function beyond_path(): string
    {
        return dirname(__DIR__);
    }
}

if (!function_exists('beyond_copy_stub')) {
    function beyond_copy_stub(string $stub, string $path, array $refactor = []): void
    {
        $action = new CopyAndRefactorFileAction(
            new CopyFileAction(),
            new RefactorFileAction()
        );

        $action->execute(
            $stub,
            $path,
            $refactor,
            true
        );
    }
}

if (!function_exists('beyond_commands')) {
    function beyond_commands(array $except = [])
    {
        return array_filter(
            Artisan::all(),
            function ($command, $key) use ($except) {
                return str_starts_with($key, 'beyond:') && !in_array($key, $except, true);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
