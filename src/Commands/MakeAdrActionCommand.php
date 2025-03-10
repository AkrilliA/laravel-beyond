<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeAdrActionCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:adr-action {name} {--force}';

    protected $description = 'Make a new ADR action';

    protected function getStub(): string
    {
        return 'controller.invokable.stub';
    }

    public function getType(): Type
    {
        return new Type('Action');
    }
}
