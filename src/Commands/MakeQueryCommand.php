<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeQueryCommand extends BaseCommand
{
    protected $signature = 'beyond:make:query {name?} {--force}';

    protected $description = 'Make a new query';

    protected array $requiredPackages = [
        'spatie/laravel-query-builder',
    ];

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'query.stub',
                $schema->path('Queries'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Query created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
