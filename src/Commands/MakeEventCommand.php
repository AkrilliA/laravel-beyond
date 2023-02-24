<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;

class MakeEventCommand extends DomainCommand
{
    protected $signature = 'beyond:make:event {name} {--force}';

    protected $description = 'Make a new event';

    protected function getStub(): string
    {
        return 'event.stub';
    }

    public function getType(): string
    {
        return 'Event';
    }
}
