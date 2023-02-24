<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;

class MakeMiddlewareCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:middleware {name} {--force}';

    protected $description = 'Make a new middleware';

    protected function getStub(): string
    {
        return 'middleware.stub';
    }

    public function getType(): string
    {
        return 'Middleware';
    }
}
