<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;

class MakeResourceCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:resource {name?} {--collection} {--force}';

    protected $description = 'Make a new resource';

    protected function getStub(): string
    {
        return $this->option('collection')
            ? 'resoource.collection.stub'
            : 'resource.stub';
    }

    public function getType(): string
    {
        return 'Resource';
    }
}
