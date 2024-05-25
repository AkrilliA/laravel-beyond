<?php

use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use AkrilliA\LaravelBeyond\Actions\CopyFileAction;
use AkrilliA\LaravelBeyond\Actions\NormalizePathAction;
use AkrilliA\LaravelBeyond\Actions\RefactorFileAction;
use Illuminate\Filesystem\Filesystem;

if (! function_exists('beyond_path')) {
    function beyond_path(string $path = ''): string
    {
        return base_path('src/'.ltrim($path, '/'));
    }
}

if (! function_exists('beyond_app_path')) {
    function beyond_app_path(string $path = ''): string
    {
        return beyond_path('Application/'.ltrim($path, '/'));
    }
}

if (! function_exists('beyond_domain_path')) {
    function beyond_domain_path(string $path = ''): string
    {
        return beyond_path('Domain/'.ltrim($path, '/'));
    }
}

if (! function_exists('beyond_support_path')) {
    function beyond_support_path(string $path = ''): string
    {
        return beyond_path('Support/'.ltrim($path, '/'));
    }
}

if (! function_exists('beyond_copy_stub')) {
    /**
     * @param  array<string, string>  $refactor
     */
    function beyond_copy_stub(string $stub, string $path, array $refactor = [], bool $force = false): void
    {
        $stub = file_exists($stubPath = base_path('stubs/beyond.'.$stub))
            ? $stubPath
            : __DIR__.'/../stubs/'.$stub;

        $action = new CopyAndRefactorFileAction(
            new CopyFileAction(new NormalizePathAction()),
            new RefactorFileAction()
        );

        $action->execute(
            $stub,
            $path,
            $refactor,
            $force
        );
    }
}

if (! function_exists('beyond_get_choices')) {
    /**
     * @return array<string>
     */
    function beyond_get_choices(string $path): array
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists($path);

        return array_map(
            function ($directory) {
                return last(explode(DIRECTORY_SEPARATOR, $directory));
            },
            $fs->directories($path)
        );
    }
}
