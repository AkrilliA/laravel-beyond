<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\SupportCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeCastCommand extends SupportCommand
{
    protected $signature = 'beyond:make:cast {name} {--force}';

    protected $description = 'Make a new cast';

    protected function getStub(): string
    {
        return 'cast.stub';
    }

    public function getType(): Type
    {
        return new Type('Cast');
    }
}
