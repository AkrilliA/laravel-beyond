<?php

namespace Regnerisch\LaravelBeyond\Schema;

class DomainSchema extends BaseSchema
{
    public function path(?string $directory): string
    {
        if ($directory) {
            return sprintf(
                '%s/src/Domain/%s/%s/%s.php',
                base_path(),
                $this->namespacePath(),
                $directory,
                $this->className
            );
        }

        return sprintf(
            '%s/src/Domain/%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $this->className
        );
    }
}
