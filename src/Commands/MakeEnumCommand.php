<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeEnumCommand extends DomainCommand
{
    protected $signature = 'beyond:make:enum {name} {--force}';

    protected $description = 'Make a new enum type';

    protected function getStub(): string
    {
        return 'enum.stub';
    }

    public function getType(): Type
    {
        return new Type('Enum');
    }
}
