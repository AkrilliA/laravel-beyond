<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class InfrastructureCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Infrastructure\\%s\\%s';
    }

    public function getBaseCommandName(): string
    {
        return 'Infrastructure';
    }
}
