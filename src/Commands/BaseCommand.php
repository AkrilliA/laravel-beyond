<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected array $requiredPackages = [];

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ([] !== $missingPackages = $this->getMissingPackages()) {
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

    protected function getMissingPackages(): array
    {
        if (empty($this->requiredPackages)) {
            return [];
        }

        $composer = $this->getLaravel()->get(ComposerContract::class);

        $missing = [];
        foreach ($this->requiredPackages as $package) {
            if (!$composer->isPackageInstalled($package)) {
                $missing[] = $package;
            }
        }

        return $missing;
    }
}
