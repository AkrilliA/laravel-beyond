<?php

namespace Regnerisch\LaravelBeyond\Schema;

class AppSchema extends BaseSchema
{
    public function path(?string $directory): string
    {
        if ($directory) {
            return sprintf(
                '%s/src/App/%s/%s/%s.php',
                base_path(),
                $this->namespacePath(),
                $directory,
                $this->className
            );
        }

        return sprintf(
            '%s/src/App/%s/%s.php',
            base_path(),
            $this->namespacePath(),
            $this->className
        );
    }
}
