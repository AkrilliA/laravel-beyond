<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeListenerCommand extends Command
{
    protected $signature = 'beyond:make:listener {name?}';

    protected $description = 'Make a new listener';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'listener.stub',
                $schema->path('Listeners'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info('Listener created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
