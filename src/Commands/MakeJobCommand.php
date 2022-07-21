<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeJobCommand extends Command
{
    protected $signature = 'beyond:make:job {name?} {--overwrite}';

    protected $description = 'Make a new job';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'job.stub',
                $schema->path('Jobs'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->info('Job created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
