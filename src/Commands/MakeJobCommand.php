<?php

namespace AkrilliA\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeJobCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:job {name?} {--force}';

    protected $description = 'Make a new job';

    protected function getType(): string
    {
        return 'Job';
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
