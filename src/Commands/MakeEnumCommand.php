<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeEnumCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:enum {name?} {--force}';

    protected $description = 'Make a new enum type';

    protected function getMinimumPHPVersionId(): int
    {
        return 80100;
    }

    protected function getType(): string
    {
        return 'Enum';
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
