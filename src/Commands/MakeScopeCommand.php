<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeScopeCommand extends DomainCommand
{
    protected $signature = 'beyond:make:scope {name} {--g|global} {--force}';

    protected $description = 'Make a new scope';

    protected function getStub(): string
    {
        return 'scope.stub';
    }

    public function getType(): Type
    {
        return new Type('Scope');
    }
}
