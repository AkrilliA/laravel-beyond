<?php

namespace Regnerisch\LaravelBeyond\Schema;

class SupportSchema extends BaseSchema
{
    public function path(?string $directory): string
    {
        if ($directory) {
            return sprintf(
                '%s/src/Support/%s/%s.php',
                base_path(),
                $directory,
                $this->className
            );
        }

        return sprintf(
            '%s/src/Support/%s.php',
            base_path(),
            $this->className
        );
    }
}
