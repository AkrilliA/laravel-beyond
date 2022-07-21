<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakePolicyCommand extends Command
{
    protected $signature = 'beyond:make:policy {name?} {--model=} {--overwrite}';

    protected $description = 'Make a new policy';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $model = $this->option('model');
            $overwrite = $this->option('overwrite');

            $stub = $model ? 'policy.stub' : 'policy.plain.stub';

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Policies'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                    '{{ modelName }}' => $model,
                    '{{ modelVariable }}' => 'User' === $model ? 'object' : mb_strtolower($model),
                ],
                $overwrite
            );

            $this->info('Policy created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
