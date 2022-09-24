<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeActionCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:action {name?} {--force} {--queueable}';

    protected $description = 'Make a new action';

    protected function getDirectoryName(): string
    {
        return 'Actions';
    }

    protected function getType(): string
    {
        return 'Action';
    }

    protected function getStub(): string
    {
        if ($this->option('queueable')) {
            return 'stubs/beyond.action.queueable.stub';
        }

        return 'stubs/beyond.action.stub';
    }

    protected function getRequiredPackages(): array
    {
        return [
            'spatie/laravel-queueable-action' => $this->option('queueable'),
        ];
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
        ];
    }
}
