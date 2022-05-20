<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeControllerCommand extends Command
{
    protected $signature = 'beyond:make:controller {name?} {--api}';

    protected $description = 'Make a new controller';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $api = $this->option('api');

            $stub = $api ? 'controller.api.stub' : 'controller.stub';

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $stub,
                base_path() . '/src/App/' . $schema->path('Controllers') . '.php',
                [
                    '{{ application }}' => $schema->appName(),
                    '{{ module }}' => $schema->moduleName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info("Controller created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
