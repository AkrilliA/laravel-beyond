<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeJobCommand extends BaseCommand
{
    protected $signature = 'beyond:make:job {name?} {--force}';

    protected $description = 'Make a new job';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'job.stub',
                $schema->path('Jobs'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Job created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
