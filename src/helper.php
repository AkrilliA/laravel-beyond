<?php

use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use AkrilliA\LaravelBeyond\Actions\CopyFileAction;
use AkrilliA\LaravelBeyond\Actions\RefactorFileAction;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
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
        return base_path("modules/$path");
    }
}

if (! function_exists('beyond_module_name')) {
    function beyond_module_name(string $name): string
    {
        return Str::of($name)->studly()->ucfirst()->value();
    }
}

if (! function_exists('beyond_copy_stub')) {
    function beyond_copy_stub(string $stub, string $path, array $refactor = [], bool $force = false): void
    {
        $stub = file_exists($stubPath = base_path('stubs/beyond.'.$stub))
            ? $stubPath
            : beyond_path().'/stubs/'.$stub;

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
    function beyond_get_choices(string $path): array
    {
        $fs = new Filesystem();

        $fs->ensureDirectoryExists($path);

        $directories = array_map(
            function ($directory) {
                return last(explode('/', $directory));
            },
            $fs->directories($path)
        );

        return $directories;
    }
}

if (! function_exists('beyond_commands')) {
    function beyond_commands(array $except = [])
    {
        return array_filter(
            Artisan::all(),
            function ($command, $key) use ($except) {
                return str_starts_with($key, 'beyond:') && ! in_array($key, $except, true);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
