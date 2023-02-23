<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeActionCommand extends DomainCommand
{
    protected $signature = 'beyond:make:action {name} {--force}';

    protected $description = 'Make a new action';

    protected function getStub(): string
    {
        return 'action.stub';
    }

    public function getType(): string
    {
        return 'Action';
    }
}
