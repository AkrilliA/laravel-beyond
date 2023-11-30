<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeControllerCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:controller {name} {--api} {--i|invokable} {--force}';

    protected $description = 'Make a new controller';

    protected function getStub(): string
    {
        $api = $this->option('api');
        $invokable = $this->option('invokable');

        return match (true) {
            $api && ! $invokable => 'controller.api.stub',
            $invokable && ! $api => 'controller.invokable.stub',
            default              => 'controller.stub'
        };
    }

    public function getType(): Type
    {
        return new Type('Controller');
    }
}
