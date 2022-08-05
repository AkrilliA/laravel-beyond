<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeQueryCommand extends Command
{
    protected $signature = 'beyond:make:query {name?} {--overwrite}';

    protected $description = 'Make a new query';

    protected array $requiredPackages = [
        'spatie/laravel-query-builder',
    ];

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'query.stub',
                $schema->path('Queries'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Query created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
