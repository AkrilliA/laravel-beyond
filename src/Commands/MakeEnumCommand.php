<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeEnumCommand extends Command
{
    protected $signature = 'beyond:make:enum {name}';

    protected $description = 'Make a new enum type';

    public function handle()
    {
        try {
            $name = $this->argument('name');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'enum.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Enums') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );

            $this->info('Enum created.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
