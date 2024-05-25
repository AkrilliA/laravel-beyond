<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class ApplicationCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Application\\%s\\%s';
    }
}
