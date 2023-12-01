<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use AkrilliA\LaravelBeyond\Type;
use function Laravel\Prompts\info;
use function Laravel\Prompts\note;

class MakeBuilderCommand extends DomainCommand
{
    protected $signature = 'beyond:make:builder {name} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected function getStub(): string
    {
        return 'builder.stub';
    }

    public function getType(): Type
    {
        return new Type('Builder');
    }

    public function setup(NameResolver $fqn): void
    {
        $this->addOnSuccess(function (string $namespace, string $className) {
            info('Please add following code to your related model');
            note('public function newEloquentBuilder($query)');
            note('{');
            note("\t".'return new '.$className.'($query);');
            note('}');
        });
    }
}
