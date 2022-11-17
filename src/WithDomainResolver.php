<?php

namespace AkrilliA\LaravelBeyond;

use AkrilliA\LaravelBeyond\Exceptions\AbortCommandException;
use AkrilliA\LaravelBeyond\Exceptions\InvalidNameSchemaException;

trait WithDomainResolver
{
    protected function getDomainSchemaFromName(?string $name, string $type): string
    {
        try {
            $schema = $this->parseDomainString($name);

            while (!$schema['DOMAIN']) {
                $schema['DOMAIN'] = $this->anticipate('Please enter the domain name for your ' . $type, []);
            }

            while (!$schema['CLASS']) {
                $schema['CLASS'] = $this->ask('Please enter the class name for your ' . $type);
            }
        } catch (InvalidNameSchemaException $exception) {
            throw new AbortCommandException($exception->getMessage());
        }

        return implode('/', $schema);
    }

    protected function getDomainNamespaceFromSchema(string $schema, string $directoryName): int|string
    {
        $parts = explode('/', $schema);

        $className = array_pop($parts);

        return 'Domain\\' . implode('\\', $parts) . '\\' . $directoryName;
    }

    protected function parseDomainString(?string $name): array
    {
        if (empty($name)) {
            return ['DOMAIN' => null, 'CLASS' => null];
        }

        $parts = explode('/', $name);

        if (2 === count($parts)) {
            return ['DOMAIN' => $parts[0], 'CLASS' => $parts[1]];
        }

        if (1 === count($parts)) {
            return ['DOMAIN' => null, 'CLASS' => $parts[0]];
        }

        throw new InvalidNameSchemaException("Invalid domain name schema: \"{$name}\"");
    }
}
