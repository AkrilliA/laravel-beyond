<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;

class MakeObserverCommand extends DomainCommand
{
    protected $signature = 'beyond:make:observer {name} {--force}';

    protected $description = 'Make a new observer';

    protected function getStub(): string
    {
        return 'observer.stub';
    }

    public function getType(): string
    {
        return 'Observer';
    }
}
