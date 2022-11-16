<?php

namespace AkrilliA\LaravelBeyond\Contracts;

interface Schema
{
    public function namespace(): string;

    public function namespacePath(): string;

    public function className(): string;

    public function path(?string $directory = null): string;
}
