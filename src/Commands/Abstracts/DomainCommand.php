<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class DomainCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Domain\\%s\\%s';
    }
}