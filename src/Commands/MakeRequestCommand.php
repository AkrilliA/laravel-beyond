<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeRequestCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:request {name} {--force}';

    protected $description = 'Make a new request';

    public function getType(): string
    {
        return 'Request';
    }

    protected function getStub(): string
    {
        return 'request.stub';
    }
}
