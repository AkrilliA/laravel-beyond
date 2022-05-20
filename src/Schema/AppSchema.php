<?php

namespace Regnerisch\LaravelBeyond\Schema;

class AppSchema
{
    public function __construct(
        protected string $appName,
        protected string $moduleName,
        protected string $className
    ) {
    }

    public function appName(): string
    {
        return $this->appName;
    }

    public function moduleName(): string
    {
        return $this->moduleName;
    }

    public function className(): string
    {
        return $this->className;
    }

    public function path(string $directory): string
    {
        return sprintf(
            '%s/%s/%s/%s',
            $this->appName,
            $this->moduleName,
            $directory,
            $this->className
        );
    }
}
