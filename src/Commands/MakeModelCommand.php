<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Illuminate\Support\Str;

class MakeModelCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:model {name?} {--f|factory} {--m|migration} {--force}';

    protected $description = 'Make a new model';

    protected function directoryName(): string
    {
        return 'Models';
    }

    protected function getStub(): string
    {
        return 'stubs/beyond.model.stub';
    }

    protected function getType(): string
    {
        return 'Model';
    }
}
