<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ModuleCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeServiceProviderCommand extends ModuleCommand
{
    protected $signature = 'beyond:make:provider {name} {--force}';

    protected $description = 'Create a new service provider';

    public function getType(): Type
    {
        return new Type('Service Provider');
    }

    protected function getStub(): string
    {
        return 'service.provider.stub';
    }
}
