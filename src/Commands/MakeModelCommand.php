<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeModelCommand extends DomainCommand
{
    protected $signature = 'beyond:make:model {name} {--force}';

    protected $description = 'Make a new model';

    protected function getStub(): string
    {
        return 'model.stub';
    }

    public function getType(): Type
    {
        return new Type('Model');
    }
}
