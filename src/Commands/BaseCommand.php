<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Regnerisch\LaravelCommandHooks\Command;

abstract class BaseCommand extends Command
{
    protected array $requiredPackages = [];

    public ?int $minimumVersion = null;

    protected function before(): int
    {
        if ($code = $this->checkVersionId()) {
            return $code;
        }

        if ($code = $this->checkDependencies()) {
            return $code;
        }

        return 0;
    }

    protected function checkDependencies(): int
    {
        if ([] === $missingPackages = $this->getMissingPackages()) {
            return 0;
        }

        $this->components->error(
            sprintf(
                'There are missing packages. Run composer require %s to install them.',
                implode(' ', $missingPackages)
            )
        );

        foreach ($missingPackages as $missingPackage) {
            $this->components->twoColumnDetail($missingPackage, 'MISSING');
        }

        return 1;
    }

    protected function checkVersionId(): int
    {
        if (!$this->minimumVersion) {
            return 0;
        }

        if (version_compare(PHP_VERSION_ID, $this->minimumVersion, '<')) {
            $this->components->error(
                sprintf(
                    'Your version %s does not match the required version %s of this command.',
                    PHP_VERSION,
                    $this->minimumVersion
                )
            );

            return 1;
        }

        return 0;
    }

    protected function getMissingPackages(): array
    {
        $composer = $this->getLaravel()->get(ComposerContract::class);

        return array_diff($this->requiredPackages, $composer->getPackages()['require']);
    }
}
