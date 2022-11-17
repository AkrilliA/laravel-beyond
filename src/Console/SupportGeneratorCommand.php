<?php

namespace AkrilliA\LaravelBeyond\Console;

use AkrilliA\LaravelBeyond\WithSupportResolver;

abstract class SupportGeneratorCommand extends GeneratorCommand
{
    use WithSupportResolver;

    public function getSchema(?string $name, string $type): string
    {
        return $this->getSupportSchemaFromName($name, $type);
    }

    public function getNamespaceFromSchema(string $schema, string $directoryName): string
    {
        return $this->getSupportNamespaceFromSchema($schema, $directoryName);
    }
}
