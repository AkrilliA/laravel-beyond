<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeServiceProviderCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:provider {name} {--force}';

    protected $description = 'Create a new service provider';

    public function getType(): Type
    {
        return new Type('Providers', 'Service Provider');
    }

    protected function getStub(): string
    {
        return 'service.provider.stub';
    }
}
