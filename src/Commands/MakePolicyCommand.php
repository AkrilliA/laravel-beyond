<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakePolicyCommand extends Command
{
    protected $signature = 'beyond:make:policy {name} {--model=}';

    protected $description = 'Make a new policy';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $model = $this->option('model');

            $schema = new DomainNameSchemaResolver($name);

            $stub = $model ? 'policy.stub' : 'policy.plain.stub';

            beyond_copy_stub(
                $stub,
                base_path() . '/src/Domain/' . $schema->getPath('Policies') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                    '{{ modelName }}' => $model,
                    '{{ modelVariable }}' => $model === 'User' ? 'object' : mb_strtolower($model),
                ]
            );
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
