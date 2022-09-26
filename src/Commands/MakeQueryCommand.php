<?php

namespace Regnerisch\LaravelBeyond\Commands;

class MakeQueryCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:query {name?} {--force}';

    protected $description = 'Make a new query';

    protected function getType(): string
    {
        return 'Query';
    }

    protected function getRequiredPackages(): array
    {
        return [
            'spatie/laravel-query-builder',
        ];
    }
}
