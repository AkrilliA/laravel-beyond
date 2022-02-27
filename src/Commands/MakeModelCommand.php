<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeModelCommand extends Command
{
    protected $signature = 'beyond:make:model {name}';

    protected $description = 'Make a new model';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'model.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Models') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );

            $this->info("Model created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
