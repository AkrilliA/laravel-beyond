<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\ApplicationCommand;
use AkrilliA\LaravelBeyond\Type;

final class MakeCommandCommand extends ApplicationCommand
{
    protected $signature = 'beyond:make:command {name} {--command=command:name} {--force}';

    protected $description = 'Make a new command';

    protected function getStub(): string
    {
        return 'command.stub';
    }

    public function getType(): Type
    {
        return new Type('Command', 'Command', 'Commands');
    }

    public function setup(): void
    {
        $this->mergePlaceholders([
            '{{ command }}' => $this->option('command'),
        ]);
    }
}
