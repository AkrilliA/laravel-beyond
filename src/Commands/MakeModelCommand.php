<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\DomainGeneratorCommand;

class MakeModelCommand extends DomainGeneratorCommand
{
    protected $signature = 'beyond:make:model {name?} {--f|factory} {--m|migration} {--force}';

    protected $description = 'Make a new model';

    protected string $type = 'Model';
}
