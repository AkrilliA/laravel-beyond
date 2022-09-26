<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeRuleCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:rule {name?} {--support} {--force}';

    protected $description = 'Make a new rule';

    protected function getType(): string
    {
        return 'Rule';
    }

    protected function getStub(): string
    {
        if ($this->option('support')) {
            return 'stubs/beyond.rule.support.stub';
        }

        return 'stubs/beyond.rule.stub';
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
            ['support', null, InputOption::VALUE_NONE, 'Create a support rule'],
        ];
    }
}
