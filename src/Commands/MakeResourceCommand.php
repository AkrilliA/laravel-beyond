<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {name?} {--collection}';

    protected $description = 'Make a new resource';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $collection = $this->option('collection');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            $stub = (str_contains($schema->className(), 'Collection') || $collection) ?
                'resource.collection.stub' :
                'resource.stub';

            beyond_copy_stub(
                $stub,
                base_path() . '/src/App/' . $schema->path('Resources') . '.php',
                [
                    '{{ application }}' => $schema->appName(),
                    '{{ module }}' => $schema->moduleName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info("Resource created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
