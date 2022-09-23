<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBuilderCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:builder {name?} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected function getDirectoryName(): string
    {
        return 'Builders';
    }

    protected function getType(): string
    {
        return 'Builder';
    }

    protected function getStub(): string
    {
        return 'stubs/beyond.builder.stub';
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class']
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the builder already exists']
        ];
    }
}
