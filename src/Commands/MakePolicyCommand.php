<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakePolicyCommand extends Command
{
    protected $signature = 'beyond:make:policy {name}';

    protected $description = 'Make a new policy';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'policy.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Policies') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ]
            );
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
