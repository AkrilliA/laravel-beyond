<?php

namespace Regnerisch\LaravelBeyond\Resolvers;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Contracts\NameSchemaResolver;
use Regnerisch\LaravelBeyond\Contracts\Schema;

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
        return $this->className ?? $this->command->ask('Please enter the class name:');
    }
}
