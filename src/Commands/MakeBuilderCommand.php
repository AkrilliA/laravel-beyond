<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBuilderCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:builder {name?} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected function getType(): string
    {
        return 'Builder';
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
