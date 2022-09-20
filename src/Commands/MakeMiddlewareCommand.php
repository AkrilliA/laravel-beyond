<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeMiddlewareCommand extends BaseCommand
{
    protected $signature = 'beyond:make:middleware {name?} {--support} {--overwrite}';

    protected $description = 'Make a new middleware';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $support = $this->option('support');
            $overwrite = $this->option('overwrite');

            $stub = $support ? 'middleware.support.stub' : 'middleware.stub';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Middlewares'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Middleware created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
