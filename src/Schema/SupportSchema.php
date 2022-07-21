<?php

namespace Regnerisch\LaravelBeyond\Schema;

class SupportSchema extends BaseSchema
{
    public function path(string $directory): string
    {
        return sprintf(
            '%s/src/Support/%s/%s.php',
            base_path(),
            $directory,
            $this->className
        );
    }
}
