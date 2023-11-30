<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class TestCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Modules\\%s\\Tests\\%s';
    }
}
