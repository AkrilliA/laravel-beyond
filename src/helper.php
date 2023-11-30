<?php

use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use AkrilliA\LaravelBeyond\Actions\CopyFileAction;
use AkrilliA\LaravelBeyond\Actions\RefactorFileAction;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

if (! function_exists('beyond_path')) {
    function beyond_path(): string
    {
        return dirname(__DIR__);
    }
}

if (! function_exists('beyond_modules_path')) {
    function beyond_modules_path(string $path = ''): string
    {
        return base_path(beyond_os_aware_path("modules/$path"));
    }
}

if (! function_exists('beyond_module_name')) {
    function beyond_module_name(string $name): string
    {
        return Str::of($name)->studly()->ucfirst()->value();
    }
}

if (! function_exists('beyond_copy_stub')) {
    /**
     * @param  array<string, string>  $refactor
     */
    function beyond_copy_stub(string $stub, string $path, array $refactor = [], bool $force = false): void
    {
        $stub = file_exists($stubPath = base_path(beyond_os_aware_path('stubs/beyond.'.$stub)))
            ? $stubPath
            : beyond_os_aware_path(beyond_path().'/stubs/'.$stub);

        $action = new CopyAndRefactorFileAction(
            new CopyFileAction(),
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

        $directories = array_map(
            function ($directory) {
                return last(explode(DIRECTORY_SEPARATOR, $directory));
            },
            $fs->directories($path)
        );

        return $directories;
    }
}

if (! function_exists('beyond_os_aware_path')) {
    /**
     * @return string
     */
    function beyond_os_aware_path(string $path): string
    {
        return Str::of($path)->replace('/', DIRECTORY_SEPARATOR)->value();
    }
}
