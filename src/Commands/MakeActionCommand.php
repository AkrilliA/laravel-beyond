<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Console\DomainGeneratorCommand;

class MakeActionCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:action {name?} {--force} {--queueable}';

    protected $description = 'Make a new action';

    protected string $type = 'Action';

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
}
