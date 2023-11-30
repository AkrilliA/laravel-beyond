<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeDataTransferObjectCommand extends DomainCommand
{
    protected $signature = 'beyond:make:data {name} {--force}';

    /** @var array<string> */
    protected $aliases = [
        'beyond:make:dto',
    ];

    protected $description = 'Make a new data transfer object';

    protected function getStub(): string
    {
        return 'data-transfer-object.stub';
    }

    public function getType(): Type
    {
        return new Type('DataObject');
    }
}
