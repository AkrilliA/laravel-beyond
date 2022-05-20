<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeCommand extends Command
{
    protected $signature = 'beyond:make';

    protected $description = 'Execute a beyond make command.';

    protected $commands = [];

    public function handle(): void
    {
        $input = $this->choice('Which command?', array_keys($this->commands()));

        $this->call($this->command($input), $this->getArguments());
    }

    protected function command(string $input): ?string
    {
        $command = $this->commands()[$input] ?? null;

        if (null === $command) {
            return null;
        }

        return get_class($command);
    }

    protected function commands(): array
    {
        $hidden = ['beyond:make', 'beyond:make:provider', 'beyond:setup'];

        $commands = beyond_commands();

        return array_filter($commands, function ($command) use ($hidden) {
            return !in_array($command, $hidden);
        });
    }
}
