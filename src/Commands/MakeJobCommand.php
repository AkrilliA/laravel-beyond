<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeJobCommand extends Command
{
    protected $signature = 'beyond:make:job {name}';

    protected $description = 'Make a new job';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = new AppNameSchemaResolver($name);

            beyond_copy_stub(
                'job.stub',
                base_path() . '/src/App/' . $schema->getPath('Jobs') . '.php',
                [
                    '{{ application }}' => $schema->getAppName(),
                    '{{ module }}' => $schema->getModuleName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );

            $this->info("Job created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
