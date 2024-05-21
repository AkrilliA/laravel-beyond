<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeCollectionCommand extends DomainCommand
{
    protected $signature = 'beyond:make:collection {name} {--force}';

    protected $description = 'Make a new collection';

    protected function getStub(): string
    {
        return 'collection.stub';

    }

    public function getType(): Type
    {
        return new Type('Collection');
    }
}
