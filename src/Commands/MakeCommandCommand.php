<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeCommandCommand extends Command
{
    protected $signature = 'beyond:make:command {name?} {appName?} {moduleName?} {--command=command:name}';

    protected $description = 'Make a new command';

    public function handle()
    {
        $name = $this->argument('name');
        $command = $this->option('command');

        $schema = (new AppNameSchemaResolver($this, $name, 'Command', 'Console'))->handle();

        beyond_copy_stub(
            'command.stub',
            base_path() . "/src/App/{$schema->appName()}/{$schema->moduleName()}/{$schema->className()}.php",
            [
                '{{ className }}' => $name,
                '{{ command }}' => $command,
            ]
        );

        $this->info('Command created.');
    }
}
