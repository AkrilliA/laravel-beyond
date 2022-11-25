<?php

namespace AkrilliA\LaravelBeyond\Resolvers;

use AkrilliA\LaravelBeyond\Contracts\NameSchemaResolver;
use AkrilliA\LaravelBeyond\Contracts\Schema;
use Illuminate\Console\Command;

abstract class BaseNameSchemaResolver implements NameSchemaResolver
{
    public function __construct(
        protected Command $command,
        protected ?string $className = null,
        protected bool $support = false
    ) {
    }

    abstract public function handle(): Schema;

    abstract protected function askNamespace(): string;

    protected function askClassName(): string
    {
        return $this->className ?? $this->command->ask('Please enter the class name');
    }

    protected function namespaceAndClassName(): array
    {
        if (! $this->className) {
            return [null, null];
        }

        $parts = explode('/', $this->className);

        if (1 === count($parts)) {
            return [null, $this->className];
        }

        $className = array_pop($parts);

        return [implode('\\', $parts), $className];
    }
}
