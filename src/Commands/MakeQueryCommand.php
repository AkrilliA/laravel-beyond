<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeQueryCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:query {name?} {--force}';

    protected $description = 'Make a new query';

    protected function getType(): string
    {
        return 'Query';
    }

    protected function getRequiredPackages(): array
    {
        return [
            'spatie/laravel-query-builder',
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
