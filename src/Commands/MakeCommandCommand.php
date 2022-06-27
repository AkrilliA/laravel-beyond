<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;

class MakeCommandCommand extends Command
{
    protected $signature = 'beyond:make:command {className} {--command=command:name} {--overwrite=false}';

    protected $description = 'Make a new command';

    public function handle()
    {
        $className = $this->argument('className');
        $command = $this->option('command');
        $overwrite = $this->option('overwrite');

        beyond_copy_stub(
            'command.stub',
            base_path() . "/src/App/Console/Commands/{$className}.php",
            [
                '{{ className }}' => $className,
                '{{ command }}' => $command,
            ],
            $overwrite
        );

        $this->info("Command created.");
    }
}
