<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeRuleCommand extends BaseCommand
{
    protected $signature = 'beyond:make:rule {name?} {--support} {--force}';

    protected $description = 'Make a new rule';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $support = $this->option('support');
            $force = $this->option('force');

            $stub = $support ? 'rule.support.stub' : 'rule.stub';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Rules'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            $this->components->info('Rule created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
