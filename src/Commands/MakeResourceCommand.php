<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeResourceCommand extends Command
{
    protected $signature = 'beyond:make:resource {name} {--collection} {--overwrite=false}';

    protected $description = 'Make a new resource';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $collection = $this->option('collection');
            $overwrite = $this->option('overwrite');

            $schema = new AppNameSchemaResolver($name);

            $stub = (str_contains($schema->getClassName(), 'Collection') || $collection) ?
                'resource.collection.stub' :
                'resource.stub';

            beyond_copy_stub(
                $stub,
                base_path() . '/src/App/' . $schema->getPath('Resources') . '.php',
                [
                    '{{ application }}' => $schema->getAppName(),
                    '{{ module }}' => $schema->getModuleName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite
            );

            $this->info("Resource created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
