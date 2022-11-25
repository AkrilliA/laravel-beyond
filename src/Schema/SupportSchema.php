<?php

namespace AkrilliA\LaravelBeyond\Schema;

class SupportSchema extends BaseSchema
{
    public function path(?string $directory = null): string
    {
        $directory = trim($directory, '/');

        return sprintf(
            '%s/src/Support%s/%s.php',
            base_path(),
            $directory ? '/'.$directory : '',
            $this->className
        );
    }
}
