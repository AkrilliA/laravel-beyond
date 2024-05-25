<?php

namespace AkrilliA\LaravelBeyond\Commands\Abstracts;

abstract class SupportCommand extends BaseCommand
{
    public function getNamespaceTemplate(): string
    {
        return 'Support\\%s';
    }
}
