<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Regnerisch\LaravelCommandHooks\Command;

abstract class BaseCommand extends Command
{
    protected ?int $minimumPHPVersionId = null;

    protected array $requiredPackages = [];

    abstract protected function getDirectoryName(): string;

    abstract protected function getStub(): string;

    abstract protected function getType(): string;

    protected function before(): int
    {
        if (!$this->matchesMinimumPHPVersionId()) {
            $this->components->error('Requires at least PHP version ' . $this->minimumPHPVersionId);

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

        if (!$this->option('force') && $this->alreadyExists('')) {
            $this->components->error($this->getType() . ' already exists.');

            return 1;
        }

        return 0;
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . '/../../' . $stub;
    }

    protected function getReplacements(): array
    {
        return [];
    }

    protected function resolvePathFromNamespace(string $namespace): string
    {
        return $this->laravel->basePath() . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', '/', $namespace) . '.php';
    }

    protected function getNameInput(): string
    {
        return $this->argument('name');
    }

    protected function matchesMinimumPHPVersionId(): bool
    {
        if (!$this->minimumPHPVersionId) {
            return true;
        }

        return PHP_VERSION_ID >= $this->minimumPHPVersionId;
    }

    protected function getMissingRequiredPackages(): array
    {
        if (!$this->requiredPackages) {
            return [];
        }

        $composer = $this->laravel->get(ComposerContract::class);

        return array_diff($this->requiredPackages, $composer->getPackages()['require']);
    }

    protected function alreadyExists(string $path): bool
    {
        return file_exists($path);
    }
}
