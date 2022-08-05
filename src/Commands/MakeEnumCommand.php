<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeEnumCommand extends Command
{
    protected $signature = 'beyond:make:enum {name?} {--overwrite}';

    protected $description = 'Make a new enum type';

    public function handle()
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'enum.stub',
                $schema->path('Enums'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('Enum created.');
        } catch (\Exception $e) {
            $this->components->error($e->getMessage());
        }
    }
}
