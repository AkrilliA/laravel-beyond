<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeActionCommand extends DomainCommand
{
    protected $signature = 'beyond:make:action {name} {--force}';

    protected $description = 'Make a new action';

    protected function getStub(): string
    {
        return 'action.stub';
    }

    public function getType(): Type
    {
        return new Type('Action');
    }
}
