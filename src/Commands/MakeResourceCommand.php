<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeResourceCommand extends BaseCommand
{
    protected $signature = 'beyond:make:resource {name?} {--collection} {--force}';

    protected $description = 'Make a new resource';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $collection = $this->option('collection');
            $force = $this->option('force');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            $stub = (str_contains($schema->className(), 'Collection') || $collection) ?
                'resource.collection.stub' :
                'resource.stub';

            beyond_copy_stub(
                $stub,
                $schema->path('Resources'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Resource created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
