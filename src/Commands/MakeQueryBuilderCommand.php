<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeQueryBuilderCommand extends Command
{
    protected $signature = 'beyond:make:query-builder {name?}';

    protected $description = 'Make a new eloquent query builder';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'query-builder.stub',
                base_path() . '/src/Domain/' . $schema->path('QueryBuilders') . '.php',
                [
                    '{{ domain }}' => $schema->domainName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info(
                'Please add following code to your related model' . PHP_EOL . PHP_EOL .

                'public function newEloquentBuilder($query)' . PHP_EOL .
                '{' . PHP_EOL .
                "\t" . 'return new ' . $schema->className() . '($query); ' . PHP_EOL .
                '}'
            );

            $this->info('Query Builder created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
