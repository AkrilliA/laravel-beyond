<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Console\DomainGeneratorCommand;

class MakeCollectionCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:collection {name?} {--model=} {--force}';

    protected $description = 'Make a new collection';

    protected function getStub(): string
    {
        if ($this->option('model')) {
            return 'stubs/beyond.collection.stub';
        }

        return 'stubs/beyond.collection.plain.stub';
    }

    protected function getType(): string
    {
        return 'Collection';
    }

    protected function getReplacements(): array
    {
        if ($model = $this->option('model')) {
            $modelNamespace = $this->getClassNamespace($model, 'Models');
            $modelClassName = $this->getClassName($model);
        }

        return [
            '{{ modelNamespace }}' => $modelNamespace ?? null,
            '{{ modelClassName }}' => $modelClassName ?? null,
        ];
    }

    protected function after($code)
    {
        if ($model = $this->option('model')) {
            $this->call('beyond:make:model', ['name' => $model]);
        }
    }
}
