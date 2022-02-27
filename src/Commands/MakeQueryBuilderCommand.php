<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeQueryBuilderCommand extends Command
{
    protected $signature = 'beyond:make:query-builder {name}';

    protected $description = 'Make a new eloquent query builder';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'query-builder.stub',
                base_path() . '/src/Domain/' . $schema->getPath('QueryBuilders') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );

            $this->info(
                "Please add following code to your related model" . PHP_EOL . PHP_EOL .

                'public function newEloquentBuilder($query)' . PHP_EOL .
                '{' . PHP_EOL .
                "\t" . 'return new ' . $schema->getClassName() . '($query); ' . PHP_EOL .
                '}'
            );
            $this->info("Query Builder created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
