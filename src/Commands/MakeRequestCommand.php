<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeRequestCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:request {name} {--force}';

    protected $description = 'Make a new request';

    public function getType(): Type
    {
        return new Type('Request');
    }

    protected function getStub(): string
    {
        return 'request.stub';
    }
}
