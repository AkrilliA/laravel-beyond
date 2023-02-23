<?php

namespace AkrilliA\LaravelBeyond\Commands;

abstract class ApplicationCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Modules\\%s\\App\\%s';
    }
}
