<?php

namespace AkrilliA\LaravelBeyond;

use Illuminate\Support\Str;

class Type
{
    public function __construct(
        private readonly string $type,
        private readonly ?string $name = null,
        private readonly ?string $namespace = null
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name ?? Str::afterLast(Str::studly($this->type), DIRECTORY_SEPARATOR);
    }

    public function getNamespace(): string
    {
        return $this->namespace ?? Str::pluralStudly($this->type);
    }
}
