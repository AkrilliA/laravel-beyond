<?php

namespace Regnerisch\LaravelBeyond\Console;

use Regnerisch\LaravelBeyond\WithSupportResolver;

abstract class SupportGeneratorCommand extends GeneratorCommand
{
    use WithSupportResolver;
}
