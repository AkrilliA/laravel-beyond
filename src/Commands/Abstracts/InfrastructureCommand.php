<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class InfrastructureCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Modules\\%s\\Infrastructure\\%s';
    }
}
