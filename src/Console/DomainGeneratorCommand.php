<?php

namespace Regnerisch\LaravelBeyond\Console;

use Regnerisch\LaravelBeyond\WithDomainResolver;

abstract class DomainGeneratorCommand extends GeneratorCommand
{
    use WithDomainResolver;

    public function getSchema(?string $name, string $type): string
    {
        return $this->getDomainSchemaFromName($name, $type);
    }

    public function getNamespaceFromSchema(string $schema, string $directoryName): string
    {
        return $this->getDomainNamespaceFromSchema($schema, $directoryName);
    }
}
