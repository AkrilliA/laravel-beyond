<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Composer;
use Illuminate\Console\Command as BaseCommand;
use Regnerisch\LaravelBeyond\Exceptions\RequiredPackagesAreMissingException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends BaseCommand
{
    protected array $requiredPackages = [];

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (false === $this->requiredPackagesAreInstalled()) {
            $missingPackages = $this->getMissingPackages();

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

        return parent::execute($input, $output);
    }

    protected function requiredPackagesAreInstalled(): bool
    {
        if ($this->requiredPackages === []) {
            return true;
        }

        $composer = Composer::getInstance();

        foreach ($this->requiredPackages as $package) {
            if (false === $composer->isPackageInstalled($package)) {
                return false;
            }
        }

        return true;
    }

    protected function getMissingPackages(): array
    {
        $missingPackages = [];

        if ($this->requiredPackages === []) {
            return $missingPackages;
        }

        $composer = Composer::getInstance();

        foreach ($this->requiredPackages as $package) {
            if (false === $composer->isPackageInstalled($package)) {
                $missingPackages[] = $package;
            }
        }

        return $missingPackages;
    }
}