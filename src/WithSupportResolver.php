<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Exceptions\AbortCommandException;
use AkrilliA\LaravelBeyond\Exceptions\InvalidNameSchemaException;

trait WithSupportResolver
{
    protected function getSupportSchemaFromName(?string $name, string $type): string
    {
        try {
            $schema = $this->parseSupportString($name);

            while (!$schema['CLASS']) {
                $schema['CLASS'] = $this->ask('Please enter the class name for your ' . $type);
            }
        } catch (InvalidNameSchemaException $exception) {
            throw new AbortCommandException($exception->getMessage());
        }

        return implode('/', $schema);
    }

    protected function getSupportNamespaceFromSchema(string $schema, string $directoryName): int|string
    {
        $parts = explode('/', $schema);

        $className = array_pop($parts);

        return 'Support\\' . implode('\\', $parts) . '\\' . $directoryName;
    }

    protected function parseSupportString(?string $name): array
    {
        if (empty($name)) {
            return ['CLASS' => null];
        }

        $parts = explode('/', $name);

        if (1 === count($parts)) {
            return ['CLASS' => $parts[0]];
        }

        throw new InvalidNameSchemaException("Invalid support name schema: \"{$name}\"");
    }
}
