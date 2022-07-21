<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeControllerCommand extends Command
{
    protected $signature = 'beyond:make:controller {name} {--api} {--overwrite}';

    protected $description = 'Make a new controller';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $api = $this->option('api');
            $overwrite = $this->option('overwrite');

            $stub = $api ? 'controller.api.stub' : 'controller.stub';

            $schema = new AppNameSchemaResolver($name);

            beyond_copy_stub(
                $stub,
                base_path() . '/src/App/' . $schema->getPath('Controllers') . '.php',
                [
                    '{{ application }}' => $schema->getAppName(),
                    '{{ module }}' => $schema->getModuleName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite
            );

            $this->info("Controller created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
