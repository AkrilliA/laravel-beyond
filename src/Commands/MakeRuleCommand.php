<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeRuleCommand extends BaseCommand
{
    protected $signature = 'beyond:make:rule {name?} {--support} {--overwrite}';

    protected $description = 'Make a new rule';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $support = $this->option('support');
            $overwrite = $this->option('overwrite');

            $stub = $support ? 'rule.support.stub' : 'rule.stub';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path('Rules'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Rule created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
