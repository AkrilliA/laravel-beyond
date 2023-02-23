<?php

namespace AkrilliA\LaravelBeyond\Commands;

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

    public function onSuccess(string $namespace, string $className): void
    {
        $this->info(
            'Please add following code to your related model'.PHP_EOL.PHP_EOL.

            'public function newEloquentBuilder($query)'.PHP_EOL.
            '{'.PHP_EOL.
            "\t".'return new '.$className.'($query); '.PHP_EOL.
            '}'
        );
    }
}
