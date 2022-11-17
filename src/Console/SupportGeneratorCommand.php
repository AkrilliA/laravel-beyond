<?php

namespace AkrilliA\LaravelBeyond\Console;

use AkrilliA\LaravelBeyond\WithSupportResolver;

abstract class SupportGeneratorCommand extends GeneratorCommand
{
    use WithSupportResolver;
}
