<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Support\Str;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Regnerisch\LaravelCommandHooks\Command;

abstract class BaseCommand extends Command
{
    protected string $namespace;

    protected array $requiredPackages = [];

    protected function getDirectoryName(): string
    {
        return Str::plural($this->getType());
    }

    protected function getStub(): string
    {
        return 'stubs/beyond.'.Str::lower(Str::kebab($this->getType())).'.stub';
    }

    abstract protected function getType(): string;

    protected function before(): int
    {
        if (PHP_VERSION_ID < $this->getMinimumPHPVersionId()) {
            $this->components->error('Requires at least PHP version '.$this->getMinimumPHPVersionId());

            return 1;
        }

        if ([] !== $missingPackages = $this->getMissingRequiredPackages()) {
            $this->components->error(sprintf(
                'There are missing composer packages. Run `composer require %s` to install them.',
                implode(' ', $missingPackages)
            ));

            foreach ($missingPackages as $missingPackage) {
                $this->components->twoColumnDetail($missingPackage, 'MISSING');
            }

            return 1;
        }

        if (! $this->option('force') && $this->alreadyExists('')) {
            $this->components->error($this->getType().' already exists.');

            return 1;
        }

        return 0;
    }

    public function handle(): ?bool
    {
        $stub = $this->resolveStubPath($this->getStub());

        $name = $this->getNameInput();
        $classNamespace = $this->getClassNamespace($name);
        $className = $this->getClassName($name);

        $path = $this->resolvePathFromNamespace($classNamespace.'\\'.$className);

        if (! $this->option('force') && $this->alreadyExists($path)) {
            $this->components->error($this->getType().' ['.$path.'] already exists.');

            return false;
        }

        beyond_copy_stub(
            $stub,
            $path,
            array_merge(
                [
                    '{{ namespace }}' => $classNamespace,
                    '{{ className }}' => $className,
                ],
                $this->getReplacements(),
            )
        );

        $this->components->info($className.' ['.$path.'] created successfully.');

        return null;
    }

    protected function getMinimumPHPVersionId(): int
    {
        return 0;
    }

    protected function getRequiredPackages(): array
    {
        return [];
    }

    protected function getReplacements(): array
    {
        return [];
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.'/../../'.$stub;
    }

    protected function resolvePathFromNamespace(string $namespace): string
    {
        return $this->laravel->basePath().DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.str_replace('\\', '/', $namespace).'.php';
    }

    protected function getNameInput(): string
    {
        return $this->argument('name');
    }

    protected function getClassNamespace(string $name, ?string $directoryName = null): string
    {
        $module = substr($name, 0, strrpos($name, '/'));

        return $this->namespace.str_replace('/', '\\', $module).'\\'.($directoryName ?? $this->getDirectoryName());
    }

    protected function getClassName(string $name): string
    {
        return substr($name, strrpos($name, '/') + 1);
    }

    protected function getMissingRequiredPackages(): array
    {
        $packages = $this->getRequiredPackages();

        $requiredPackages = [];
        foreach ($packages as $key => $value) {
            if (is_string($value) && is_int($key)) {
                $requiredPackages[] = $value;
            } elseif (is_string($key) && $value) {
                $requiredPackages[] = $key;
            }
        }

        $composer = $this->laravel->get(ComposerContract::class);

        return array_diff($requiredPackages, $composer->getPackages()['require']);
    }

    protected function alreadyExists(string $path): bool
    {
        return file_exists($path);
    }
}
