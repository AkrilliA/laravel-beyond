<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\DomainGeneratorCommand;

class MakeDataTransferObjectCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:dto {name?} {--force}';

    protected $description = 'Make a new data transfer object';

    protected string $type = 'DataTransferObject';

    protected function getStub(): string
    {
        return '/stubs/beyond.data-transfer-objects.stub';
    }

    protected function getRequiredPackages(): array
    {
        return [
            'spatie/data-transfer-object',
        ];
    }
}
