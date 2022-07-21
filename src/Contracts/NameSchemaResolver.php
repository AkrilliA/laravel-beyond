<?php

namespace Regnerisch\LaravelBeyond\Contracts;

interface NameSchemaResolver
{
    public function handle(): Schema;
}
