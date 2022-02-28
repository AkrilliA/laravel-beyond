<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeDataTransferObjectCommand extends Command
{
    protected $signature = 'beyond:make:dto {name}';

    protected $description = 'Make a new data transfer object';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'data-transfer-object.stub',
                base_path() . '/src/Domain/' . $schema->getPath('DataTransferObjects') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );

            $this->info("DataTransferObject created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
