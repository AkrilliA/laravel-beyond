<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\SupportCommand;
use AkrilliA\LaravelBeyond\Type;

final class PublishBeyondGateCommand extends SupportCommand
{
    protected $signature = 'beyond:publish:gate {--force}';

    protected $description = 'Publish a special Gate to allow usage of application policies';

    public function getType(): Type
    {
        return new Type('Beyond', 'Beyond', 'Beyond');
    }

    protected function getStub(): string
    {
        return 'beyond.gate.stub';
    }

    protected function getNameArgument(): string
    {
        return 'Gate';
    }
}
