<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeRuleCommand extends Command
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
            $directory = $support ? 'Packages/Laravel/Rules' : 'Rules';

            $schema = (new AppNameSchemaResolver($this, $name, support: $support))->handle();

            beyond_copy_stub(
                $stub,
                $schema->path($directory),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->info('Rule created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
