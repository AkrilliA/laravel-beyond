<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Console\Command;
use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeCommandCommand extends Command
{
    protected $signature = 'beyond:make:command {name?} {appName?} {moduleName?} {--command=command:name} {--force}';

    protected $description = 'Make a new command';

    public function handle()
    {
        try {
            $name = $this->argument('name');
            $command = $this->option('command');
            $force = $this->option('force');

            $schema = (new AppNameSchemaResolver($this, $name, 'Commands', 'Console'))->handle();

            beyond_copy_stub(
                'command.stub',
                $schema->path(),
                [
                    '{{ namespace }}' => $name,
                    '{{ command }}' => $command,
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Command created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
