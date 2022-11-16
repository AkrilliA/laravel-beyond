<?php

namespace AkrilliA\LaravelBeyond\Schema;

use AkrilliA\LaravelBeyond\Contracts\Schema;

abstract class BaseSchema implements Schema
{
    public function __construct(
        protected string $namespace,
        protected string $className
    ) {
    }

    public function namespace(): string
    {
        return str_replace('/', '\\', $this->namespace);
    }

    public function namespacePath(): string
    {
        return str_replace('\\', '/', $this->namespace);
    }

    public function className(): string
    {
        return $this->className;
    }

    abstract public function path(?string $directory = null): string;
}
