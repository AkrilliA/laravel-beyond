<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Commands\Abstracts\SupportCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeRuleCommand extends SupportCommand
{
    protected $signature = 'beyond:make:rule {name?} {--force}';

    protected $description = 'Make a new rule';

    protected function getStub(): string
    {
        return 'rule.stub';
    }

    public function getType(): Type
    {
        return new Type('Rule');
    }
}
