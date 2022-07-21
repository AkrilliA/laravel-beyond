<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeModelCommand extends Command
{
    protected $signature = 'beyond:make:model {name?} {-m|--migration} {--overwrite}';

    protected $description = 'Make a new model';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'model.stub',
                $schema->path('Models'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            if ($this->option('migration')) {
                $tableName = Str::snake(Str::pluralStudly($schema->className()));
                $fileName = now()->format('Y_m_d_his') . '_create_' . $tableName . '_table';

                beyond_copy_stub(
                    'migration.stub',
                    base_path() . '/database/migrations' . $fileName . '.php',
                    [
                        '{{ tableName }}' => $tableName,
                    ],
                    $overwrite
                );
            }

            $this->info('Model created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
