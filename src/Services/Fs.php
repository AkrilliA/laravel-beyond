<?php

namespace AkrilliA\LaravelBeyond\Services;

use Illuminate\Filesystem\Filesystem;

class Fs
{
    private static self $instance;

    private Filesystem $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    public static function create(): self
    {
        if (self::$instance) {
            return self::$instance;
        }

        return self::$instance = new self();
    }

    public function directoryNames(string $path): array
    {
        $this->fs->ensureDirectoryExists($path);

        return array_map(
            fn ($directory) => last(explode('/', $directory)),
            $this->fs->directories($path)
        );
    }

    public function copyStub(string $stubName, string $path, array $replace = [], bool $force = false): void
    {
        $stub = $this->fs->exists($stubPath = base_path("stubs/beyond.{$stubName}"))
            ? $stubPath
            : __DIR__.'/../../stubs/'.$stubName;

        $this->copyFile($stub, $path, $replace, $force);
    }

    public function copyFile(string $source, string $target, array $replace = [], bool $force = false): void
    {
        $this->fs->ensureDirectoryExists(dirname($target));

        if (! $force && $this->fs->exists($target)) {
            throw new \Exception("File [$target] already exists.");
        }

        $this->fs->copy($source, $target);

        $this->replacePlaceholders($target, $replace);
    }

    public function replacePlaceholders(string $file, array $replace): void
    {
        $this->fs->put(
            $file,
            str_replace(
                array_keys($replace),
                $replace,
                $this->fs->get($file)
            )
        );
    }

    public function __call(string $name, array $arguments)
    {
        if (method_exists($this->fs, $name)) {
            return $this->fs->{$name}(...$arguments);
        }

        return $this->{$name}(...$arguments);
    }
}
