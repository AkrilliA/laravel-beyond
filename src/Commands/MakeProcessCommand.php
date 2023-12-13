<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeProcessCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:process {name} {--force}';

    protected $description = 'Make a new process';

    protected function getStub(): string
    {
        return 'process.stub';
    }

    public function getType(): Type
    {
        return new Type('Process');
    }
}
