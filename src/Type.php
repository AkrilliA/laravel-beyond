<?php

namespace AkrilliA\LaravelBeyond;

use Illuminate\Support\Str;

final readonly class Type
{
    public function __construct(
        private string $type,
        private ?string $name = null,
        private ?string $namespace = null
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
