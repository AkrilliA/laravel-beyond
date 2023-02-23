<?php

namespace AkrilliA\LaravelBeyond\Commands;

class MakeCollectionCommand extends DomainCommand
{
    protected $signature = 'beyond:make:collection {name} {--model=} {--force}';

    protected $description = 'Make a new collection';

    protected function getStub(): string
    {
        return $this->hasOption('model')
            ? 'collection.stub' :
            'collection.plain.stub';
    }

    public function getType(): string
    {
        return 'Collection';
    }
}
