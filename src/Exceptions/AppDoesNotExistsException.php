<?php

namespace AkrilliA\LaravelBeyond\Exceptions;

class AppDoesNotExistsException extends \Exception
{
    public function __construct(string $app)
    {
        parent::__construct("The given app \"{$app}\" does not exists. Did you run `php artisan beyond:make:app {$app}`?");
    }
}
