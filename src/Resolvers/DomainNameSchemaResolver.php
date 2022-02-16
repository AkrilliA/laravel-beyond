<?php

namespace Regnerisch\LaravelBeyond\Resolvers;

use Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException;

class DomainNameSchemaResolver
{
    protected array $parts = [];

    public function __construct(string $name)
    {
        $this->parts = explode('/', $name);

        if (2 !== count($this->parts)) {
            throw new InvalidNameSchemaException(
                'Invalid name schema! Please ensure the required schema: {Domain}/{ClassName}.'
            );
        }
    }

    public function getDomainName(): string
    {
        return $this->parts[0];
    }

    public function getClassName(): string
    {
        return $this->parts[1];
    }

    public function getPath(string $directory): string
    {
        $parts = $this->parts;

        array_splice($parts, 1, 0, $directory);

        return implode('/', $parts);
    }


}
