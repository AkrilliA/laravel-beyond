<?php

namespace AkrilliA\LaravelBeyond\Exceptions;

class InvalidNameException extends \Exception
{
    public function __construct(string $name)
    {
        parent::__construct("The given name \"{$name}\" is invalid. Name must be just the classname or \"{Module}/{Classname}\"");
    }
}
