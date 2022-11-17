<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\SupportGeneratorCommand;
use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use AkrilliA\LaravelBeyond\WithSupportResolver;

class MakeTraitCommand extends SupportGeneratorCommand
{
    protected $signature = 'beyond:make:trait {name?} {--force}';

    protected $description = 'Make a new trait';

    protected string $type = 'Trait';

    protected function getStub(): string
    {
        return 'stubs/beyond.trait.stub';
    }
}
