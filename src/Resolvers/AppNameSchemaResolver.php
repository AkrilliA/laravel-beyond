<?php

namespace Regnerisch\LaravelBeyond\Resolvers;

use Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException;

class AppNameSchemaResolver
{
    protected array $parts = [];

    public function __construct(string $name)
    {
        $this->parts = explode('/', $name);

        if (3 !== count($this->parts)) {
            throw new InvalidNameSchemaException(
                'Invalid name schema! Please ensure the required schema: {App}/{Module}/{ClassName}.'
            );
        }

        foreach ($this->parts as $part) {
            if (!$part) {
                throw new InvalidNameSchemaException('Invalid name schema! Please ensure that none of the required parts is empty.');
            }
        }
    }

    public function getAppName(): string
    {
        return $this->parts[0];
    }

    public function getModuleName(): string
    {
        return $this->parts[1];
    }

    public function getClassName(): string
    {
        return $this->parts[2];
    }

    public function getPath(string $directory): string
    {
        $parts = $this->parts;

        array_splice($parts, 2, 0, $directory);

        return implode('/', $parts);
    }


}
