<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;

class MakeBuilderCommand extends DomainCommand
{
    protected $signature = 'beyond:make:builder {name} {--force}';

    protected $description = 'Make a new eloquent builder';

    protected function getStub(): string
    {
        return 'builder.stub';
    }

    public function getType(): string
    {
        return 'Builder';
    }

    public function setup(NameResolver $fqn): void
    {
        $this->addOnSuccess(function (string $namespace, string $className) {
            $this->info('Please add following code to your related model');
            $this->newLine();
            $this->info('public function newEloquentBuilder($query)');
            $this->info('{');
            $this->info("\t".'return new '.$className.'($query);');
            $this->info('}');
        });
    }
}
