<?php

namespace Regnerisch\LaravelBeyond\Schema;

class DomainSchema
{
    public function __construct(
        protected string $domainName,
        protected string $className
    ) {
    }

    public function domainName(): string
    {
        return $this->domainName;
    }

    public function className(): string
    {
        return $this->className;
    }

    public function path(string $directory): string
    {
        return sprintf(
            '%s/%s/%s',
            $this->domainName,
            $directory,
            $this->className
        );
    }
}
