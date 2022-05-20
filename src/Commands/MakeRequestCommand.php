<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeRequestCommand extends Command
{
    protected $signature = 'beyond:make:request {name?}';

    protected $description = 'Make a new request';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'request.stub',
                base_path() . '/src/App/' . $schema->path('Requests') . '.php',
                [
                    '{{ application }}' => $schema->appName(),
                    '{{ module }}' => $schema->moduleName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info("Request created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
