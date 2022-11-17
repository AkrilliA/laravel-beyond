<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeControllerCommand extends ApplicationGeneratorCommand
{
    protected $signature = 'beyond:make:controller {name?} {--api} {--i|invokable} {--force}';

    protected $description = 'Make a new controller';

    protected function directoryName(): string
    {
        return 'Controllers';
    }

    protected function getStub(): string
    {
        if ($this->option('api')) {
            $stub = '/stubs/beyond.controller.api.stub';
        } elseif ($this->option('invokable')) {
            $stub = '/stubs/beyond.controller.invokable.stub';
        } else {
            $stub = '/stubs/beyond.controller.stub';
        }

        return $stub;
    }

    protected function getType(): string
    {
        return 'Controller';
    }
}
