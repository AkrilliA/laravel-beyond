<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeEventCommand extends Command
{
    protected $signature = 'beyond:make:event {name?}';

    protected $description = 'Make a new event';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'event.stub',
                base_path() . '/src/Domain/' . $schema->path('Events') . '.php',
                [
                    '{{ domain }}' => $schema->domainName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info('Event created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
