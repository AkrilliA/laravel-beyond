<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\DomainGeneratorCommand;
use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeListenerCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:listener {name?} {--force}';

    protected $description = 'Make a new listener';

    protected string $type = 'Listener';

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
