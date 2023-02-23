<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeRuleCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:rule {name?} {--force}';

    protected $description = 'Make a new rule';

    protected function getStub(): string
    {
        return 'rule.stub';
    }

    public function getType(): string
    {
        return 'Rule';
    }
}
