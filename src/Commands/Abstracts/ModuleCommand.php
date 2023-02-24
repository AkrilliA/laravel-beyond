<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class ModuleCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Modules\\%s';
    }
}
