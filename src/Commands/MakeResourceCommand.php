<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeResourceCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:resource {name?} {--collection} {--force}';

    protected $description = 'Make a new resource';

    protected function getType(): string
    {
        return 'Resource';
    }

    protected function getStub(): string
    {
        if (Str::of($this->argument('name'))->contains('Collection') || $this->option('collection')) {
            return 'stubs/beyond.resource.collection.stub';
        }

        return 'stubs/beyond.resource.stub';
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
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the action already exists'],
            ['collection', null, InputOption::VALUE_NONE, 'Create a collection'],
        ];
    }
}
