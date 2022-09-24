<?php

namespace Regnerisch\LaravelBeyond\Commands;

abstract class DomainGeneratorCommand extends BaseCommand
{
    protected string $namespace = 'Domain\\';
}
