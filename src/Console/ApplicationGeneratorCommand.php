<?php

namespace AkrilliA\LaravelBeyond\Console;

use AkrilliA\LaravelBeyond\WithApplicationResolver;

abstract class ApplicationGeneratorCommand extends GeneratorCommand
{
    use WithApplicationResolver;

    public function getSchema(?string $name, string $type): string
    {
        return $this->getAppSchemaFromName($name, $type);
    }

    public function getNamespaceFromSchema(string $schema, string $directoryName): string
    {
        return $this->getAppNamespaceFromSchema($schema, $directoryName);
    }
}
