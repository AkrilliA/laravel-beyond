<?php

namespace AkrilliA\LaravelBeyond\Commands;

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

    protected function getRefactoringParameters(): array
    {
        return [
            '{{ command }}' => $this->option('command'),
        ];
    }
}
