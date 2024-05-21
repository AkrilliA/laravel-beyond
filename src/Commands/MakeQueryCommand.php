<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeQueryCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:query {name} {--force}';

    protected $description = 'Make a new query';

    protected function getStub(): string
    {
        return 'query.stub';
    }

    public function getType(): Type
    {
        return new Type('Query');
    }
}
