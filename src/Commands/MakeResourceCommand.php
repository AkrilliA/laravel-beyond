<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {name?} {--collection} {--overwrite}';

    protected $description = 'Make a new resource';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $collection = $this->option('collection');
            $overwrite = $this->option('overwrite');

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
                $overwrite
            );

            $this->info('Resource created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
