<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeBuilderCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:builder {name?} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected function getDirectoryName(): string
    {
        return 'Builders';
    }

    protected function getStub(): string
    {
        return 'stubs/beyond.builder.stub';
    }

    protected function getType(): string
    {
        return 'Builder';
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
        ];
    }
}
