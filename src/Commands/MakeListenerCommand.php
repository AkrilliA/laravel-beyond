<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeListenerCommand extends DomainCommand
{
    protected $signature = 'beyond:make:listener {name} {--force}';

    protected $description = 'Make a new listener';

    protected function getStub(): string
    {
        return 'listener.stub';
    }

    public function getType(): string
    {
        return 'Listener';
    }
}
