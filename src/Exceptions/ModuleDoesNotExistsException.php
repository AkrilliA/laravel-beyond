<?php

namespace AkrilliA\LaravelBeyond\Exceptions;

class ModuleDoesNotExistsException extends \Exception
{
    public function __construct(string $module)
    {
        parent::__construct("The given module \"{$module}}\" does not exists. Did you run `php artisan beyond:make:module {$module}`?");
    }
}
