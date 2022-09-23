<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeCollectionCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:collection {name?} {--model=} {--force}';

    protected $description = 'Make a new collection';

    protected function getDirectoryName(): string
    {
        return 'Collections';
    }

    protected function getType(): string
    {
        return 'Collection';
    }

    protected function getStub(): string
    {
        if ($this->option('model')) {
            return 'stubs/collection.stub';
        }

        return 'stubs/collection.plain.stub';
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
            ['model', null, InputOption::VALUE_OPTIONAL, 'The model that the collection is built from'],
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the collection already exists'],
        ];
    }
}
