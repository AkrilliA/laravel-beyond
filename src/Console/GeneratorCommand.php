<?php

namespace AkrilliA\LaravelBeyond\Console;

use Illuminate\Support\Str;
use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use AkrilliA\LaravelBeyond\Exceptions\AbortCommandException;

abstract class GeneratorCommand extends Command
{
    protected string $namespace;

    protected string $type;

    abstract protected function getSchema(?string $name, string $type): string;

    abstract protected function getNamespaceFromSchema(string $schema, string $directoryName): string;

    protected function getStub(): string
    {
        $type = strtolower($this->type);

        return "stubs/beyond.$type.stub";
    }

    protected function before(): int
    {
        if (PHP_VERSION_ID < $this->getMinimumPHPVersionId()) {
            throw new AbortCommandException('Requires at least PHP version ' . $this->getMinimumPHPVersionId());
        }

        if ([] !== $missingPackages = $this->getMissingRequiredPackages()) {
            $this->components->error(sprintf(
                'There are missing composer packages. Run `composer require %s` to install them.',
                implode(' ', $missingPackages)
            ));

            foreach ($missingPackages as $missingPackage) {
                $this->components->twoColumnDetail($missingPackage, 'MISSING');
            }

            throw new AbortCommandException();
        }

        return 0;
    }

    public function handle(): ?bool
    {
        $stub = $this->resolveStubPath($this->getStub());

        $schema = $this->getSchema($this->getNameInput(), $this->type);
        $classNamespace = $this->getNamespaceFromSchema($schema, $this->directoryName());
        $className = $this->getClassNameFromSchema($schema);

        $path = $this->resolvePathFromFQN($classNamespace . '\\' . $className);

        if (!$this->option('force') && $this->alreadyExists($path)) {
            $this->components->error($this->type . ' [' . $path . '] already exists.');

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

        $this->components->info($className . ' [' . $path . '] created successfully.');

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

    protected function directoryName(): string
    {
        return Str::plural($this->type);
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . '/../../' . $stub;
    }

    protected function resolvePathFromFQN(string $namespace): string
    {
        return $this->laravel->basePath() . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', '/', $namespace) . '.php';
    }

    protected function getNameInput(): ?string
    {
        return $this->argument('name');
    }

    protected function getClassNameFromSchema(string $schema): string
    {
        return last(explode('/', $schema));
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
