<?php

namespace Regnerisch\LaravelBeyond\Contracts;

interface Composer
{
    public function getPackages(): array;

    public function isPackageInstalled(string $name, bool $withRequireDev = false): bool;
}
