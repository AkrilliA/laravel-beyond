<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakePolicyCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:policy {name} {--force}';

    protected $description = 'Make a new policy';

    protected function getStub(): string
    {
        return 'policy.stub';
    }

    public function getType(): Type
    {
        return new Type('Policy');
    }
}
