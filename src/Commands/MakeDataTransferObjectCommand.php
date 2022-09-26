<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeDataTransferObjectCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:dto {name?} {--force}';

    protected $description = 'Make a new data transfer object';

    protected function getType(): string
    {
        return 'DataTransferObject';
    }

    protected function getRequiredPackages(): array
    {
        return [
            'spatie/data-transfer-object',
        ];
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
        ];
    }
}
