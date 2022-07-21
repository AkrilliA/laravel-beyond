<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeCommand extends Command
{
    protected $signature = 'beyond:make';

    protected $description = 'Execute a beyond make command.';

    protected array $commands = [];

    public function handle(): void
    {
        $input = $this->choice('Which command?', array_keys($this->commands()), null, 1);

        $this->call($this->command($input), $this->getArguments());
    }

    protected function command(string $input): string
    {
        $commands = $this->commands();

        return get_class($commands[$input]);
    }

    protected function commands(): array
    {
        if ($this->commands) {
            return $this->commands;
        }

        $except = ['beyond:make', 'beyond:make:provider', 'beyond:setup'];

        return $this->commands = beyond_commands($except);
    }
}
