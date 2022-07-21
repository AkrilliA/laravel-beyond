<?php

namespace Regnerisch\LaravelBeyond\Schema;

class AppSchema extends BaseSchema
{
    public function path(string $directory): string
    {
        return sprintf(
            '%s/src/App/%s/%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $directory,
            $this->className
        );
    }
}
