<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeQueryCommand extends Command
{
    protected $signature = 'beyond:make:query {name?}';

    protected $description = 'Make a new query';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'query.stub',
                base_path() . '/src/App/' . $schema->path('Queries') . '.php',
                [
                    '{{ application }}' => $schema->appName(),
                    '{{ module }}' => $schema->moduleName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info("Query created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
