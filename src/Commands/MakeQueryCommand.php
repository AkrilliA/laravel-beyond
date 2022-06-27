<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeQueryCommand extends Command
{
    protected $signature = 'beyond:make:query {name} {--overwrite=false}';

    protected $description = 'Make a new query';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = new AppNameSchemaResolver($name);

            beyond_copy_stub(
                'query.stub',
                base_path() . '/src/App/' . $schema->getPath('Queries') . '.php',
                [
                    '{{ application }}' => $schema->getAppName(),
                    '{{ module }}' => $schema->getModuleName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite
            );

            $this->info("Query created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
