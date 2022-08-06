<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeRequestCommand extends BaseCommand
{
    protected $signature = 'beyond:make:request {name?} {--overwrite}';

    protected $description = 'Make a new request';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'request.stub',
                $schema->path('Requests'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Request created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
