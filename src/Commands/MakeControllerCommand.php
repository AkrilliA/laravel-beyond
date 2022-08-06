<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeControllerCommand extends BaseCommand
{
    protected $signature = 'beyond:make:controller {name?} {--api} {--overwrite}';

    protected $description = 'Make a new controller';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $api = $this->option('api');
            $overwrite = $this->option('overwrite');

            $stub = $api ? 'controller.api.stub' : 'controller.stub';

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Controllers'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Controller created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
