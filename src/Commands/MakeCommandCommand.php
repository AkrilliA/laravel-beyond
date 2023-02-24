<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;

class MakeCommandCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:command {name} {--command=command:name} {--force}';

    protected $description = 'Make a new command';

    protected function getStub(): string
    {
        return 'command.stub';
    }

    public function getType(): string
    {
        return 'Commands';
    }

    public function setup()
    {
        $this->mergePlaceholders([
            '{{ command }}' => $this->option('command'),
        ]);
    }
}
