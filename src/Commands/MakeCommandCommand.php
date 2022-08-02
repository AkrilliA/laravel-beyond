<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeCommandCommand extends Command
{
    protected $signature = 'beyond:make:command {name?} {appName?} {moduleName?} {--command=command:name} {--overwrite}';

    protected $description = 'Make a new command';

    public function handle()
    {
        $name = $this->argument('name');
        $command = $this->option('command');
        $overwrite = $this->option('overwrite');

        $schema = (new AppNameSchemaResolver($this, $name, 'Commands', 'Console'))->handle();

        beyond_copy_stub(
            'command.stub',
            $schema->path(),
            [
                '{{ namespace }}' => $name,
                '{{ command }}' => $command,
            ],
            $overwrite
        );

        $this->info('Command created.');
    }
}
