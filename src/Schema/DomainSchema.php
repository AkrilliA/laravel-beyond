<?php

namespace AkrilliA\LaravelBeyond\Schema;

class DomainSchema extends BaseSchema
{
    public function path(?string $directory = null): string
    {
        $directory = trim($directory, '/');

        return sprintf(
            '%s/src/Domain/%s%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $directory ? '/'.$directory : '',
            $this->className
        );
    }
}
