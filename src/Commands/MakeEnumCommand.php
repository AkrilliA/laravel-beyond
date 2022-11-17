<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\DomainGeneratorCommand;
use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeEnumCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:enum {name?} {--force}';

    protected $description = 'Make a new enum type';

    protected string $type = 'Enum';

    protected function getMinimumPHPVersionId(): int
    {
        return 80100;
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
