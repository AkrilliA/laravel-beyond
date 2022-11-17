<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeRequestCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:request {name?} {--force}';

    protected $description = 'Make a new request';

    protected function getType(): string
    {
        return 'Request';
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
