<?php

namespace AkrilliA\LaravelBeyond\Schema;

class AppSchema extends BaseSchema
{
    public function path(?string $directory = null): string
    {
        $directory = trim($directory, '/');

        return sprintf(
            '%s/src/App/%s%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $directory ? '/'.$directory : '',
            $this->className
        );
    }
}
