<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Composer;
use Illuminate\Console\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends BaseCommand
{
    protected array $requiredPackages = [];

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $code = parent::execute($input, $output);

        $this->healthy();

        return $code;
    }

    protected function healthy(): bool
    {
        $composer = Composer::getInstance();

        if ($this->requiredPackages === []) {
            return true;
        }

        $notInstalledPackages = [];

        foreach ($this->requiredPackages as $package) {
            if (false === $composer->isPackageInstalled($package)) {
                $notInstalledPackages[] = $package;
            }
        }

        if ($notInstalledPackages) {
            $this->components->info(
                sprintf(
                    'There are missing required packages. Run composer install %s',
                    implode(' ', $notInstalledPackages)
                )
            );

            foreach ($notInstalledPackages as $package) {
                $this->components->twoColumnDetail($package, 'MISSING');
            }

            return false;
        }

        return true;
    }
}