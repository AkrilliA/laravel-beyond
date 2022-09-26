<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeMiddlewareCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:middleware {name?} {--support} {--force}';

    protected $description = 'Make a new middleware';

    protected function getDirectoryName(): string
    {
        return 'Middlewares';
    }

    protected function getType(): string
    {
        return 'Middleware';
    }

    protected function getStub(): string
    {
        if ($this->option('support')) {
            return 'stubs/beyond.middleware.support.stub';
        }

        return 'stubs/beyond.middleware.stub';
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
            ['support', null, InputOption::VALUE_NONE, 'Create a support middleware'],
        ];
    }
}
