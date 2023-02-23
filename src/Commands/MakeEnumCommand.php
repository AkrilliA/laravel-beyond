<?php

namespace AkrilliA\LaravelBeyond\Commands;

use function Orchestra\Testbench\phpunit_version_compare;

class MakeEnumCommand extends DomainCommand
{
    protected $signature = 'beyond:make:enum {name} {--force}';

    protected $description = 'Make a new enum type';

    protected function getStub(): string
    {
        return 'enum.stub';
    }

    public function getType(): string
    {
        return 'Enum';
    }
}
