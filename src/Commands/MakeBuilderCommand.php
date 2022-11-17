<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\DomainGeneratorCommand;
use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeBuilderCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:builder {name?} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected string $type = 'Builder';

    protected function getStub(): string
    {
        return 'stubs/beyond.builder.stub';
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
