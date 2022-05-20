<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeActionCommand extends Command
{
    protected $signature = 'beyond:make:action {name?}';

    protected $description = 'Make a new action';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'action.stub',
                base_path() . '/src/Domain/' . $schema->path('Actions') . '.php',
                [
                    '{{ domain }}' => $schema->domainName(),
                    '{{ className }}' => $schema->className(),
                ]
            );

            $this->info('Action created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
