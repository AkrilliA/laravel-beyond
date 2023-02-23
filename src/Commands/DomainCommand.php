<?php

namespace AkrilliA\LaravelBeyond\Commands;

abstract class DomainCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Modules\\%s\\Domain\\%s';
    }
}
