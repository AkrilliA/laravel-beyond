<?php

namespace Regnerisch\LaravelBeyond;

use Regnerisch\LaravelBeyond\Exceptions\AbortCommandException;
use Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException;

trait WithApplicationResolver
{
    protected function getAppSchemaFromName(?string $name, string $type): string
    {
        try {
            $schema = $this->parseAppString($name);

            while (!$schema['APP']) {
                $schema['APP'] = $this->anticipate('Please enter the app name for your ' . $type, []);
            }

            while (!$schema['MODULE']) {
                $schema['MODULE'] = $this->anticipate('Please enter the module name for your ' . $type, []);
            }

            while (!$schema['CLASS']) {
                $schema['CLASS'] = $this->ask('Please enter the class name for your ' . $type);
            }
        } catch (InvalidNameSchemaException $exception) {
            throw new AbortCommandException($exception->getMessage());
        }

        return implode('/', $schema);
    }

    protected function getAppNamespaceFromSchema(string $schema, string $directoryName): int|string
    {
        $parts = explode('/', $schema);

        $className = array_pop($parts);

        return 'App\\' . implode('\\', $parts) . '\\' . $directoryName;
    }

    protected function parseAppString(?string $name): array
    {
        if (empty($name)) {
            return ['APP' => null, 'MODULE' => null, 'CLASS' => null];
        }

        $parts = explode('/', $name);

        if (3 === count($parts)) {
            return ['APP' => $parts[0], 'MODULE' => $parts[1], 'CLASS' => $parts[2]];
        }

        if (1 === count($parts)) {
            return ['APP' => null, 'MODULE' => null, 'CLASS' => $parts[0]];
        }

        throw new InvalidNameSchemaException("Invalid application name schema: \"{$name}\"");
    }
}
