<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\TestCommand;
use AkrilliA\LaravelBeyond\Type;

class MakeTestCommand extends TestCommand
{
    protected $signature = 'beyond:make:test {name} {--u|unit} {--p|pest} {--force}';

    protected $description = 'Make a new test';

    protected function getStub(): string
    {
        $stubName = 'test';

        if ($this->option('unit')) {
            $stubName .= '.unit';
        }

        if ($this->option('pest')) {
            $stubName .= '.pest';
        }

        return $stubName.'.stub';
    }

    public function getType(): Type
    {
        return $this->option('unit')
            ? new Type('Unit', 'Test', 'Unit')
            : new Type('Feature', 'Test', 'Feature');
    }
}
