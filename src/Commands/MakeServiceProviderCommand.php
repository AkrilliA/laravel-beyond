<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ModuleCommand;

class MakeServiceProviderCommand extends ModuleCommand
{
    protected $signature = 'beyond:make:provider {name} {--force}';

    protected $description = 'Create a new service provider';

    public function getType(): string
    {
        return 'Service Provider';
    }

    protected function getStub(): string
    {
        return 'service.provider.stub';
    }
}
