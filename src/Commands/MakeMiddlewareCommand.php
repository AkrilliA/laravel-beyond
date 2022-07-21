<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeMiddlewareCommand extends Command
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
            $directory = $support ? 'Packages/Laravel/Middleware' : 'Middleware';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path($directory),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->info('Middleware created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
