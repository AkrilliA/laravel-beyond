<?php

namespace Regnerisch\LaravelBeyond\Schema;

class DomainSchema extends BaseSchema
{
    public function path(?string $directory): string
    {
        return sprintf(
            '%s/src/Domain/%s/%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $directory,
            $this->className
        );
    }
}
