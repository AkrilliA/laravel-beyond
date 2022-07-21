<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeActionCommand extends Command
{
    protected $signature = 'beyond:make:action {name?} {--overwrite}';

    protected $description = 'Make a new action';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'action.stub',
                $schema->path('Actions'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->info('Action created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
