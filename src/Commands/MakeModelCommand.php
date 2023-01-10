<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Illuminate\Support\Str;

class MakeModelCommand extends BaseCommand
{
    protected $signature = 'beyond:make:model {name?} {--f|factory} {--m|migration} {--force}';

    protected $description = 'Make a new model';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $force = $this->option('force');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'model.stub',
                $schema->path('Models'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $force
            );

            if ($this->option('factory')) {
                $fileName = $schema->className().'Factory';

                beyond_copy_stub(
                    'factory.stub',
                    base_path().'/database/factories/'.$fileName.'.php',
                    [
                        '{{ namespace }}' => $schema->namespace(),
                        '{{ model }}' => $schema->className(),
                    ],
                    $force
                );
            }

            if ($this->option('migration')) {
                $tableName = Str::snake(Str::pluralStudly($schema->className()));
                $fileName = now()->format('Y_m_d_his').'_create_'.$tableName.'_table';

                beyond_copy_stub(
                    'migration.create.stub',
                    base_path().'/database/migrations/'.$fileName.'.php',
                    [
                        '{{ table }}' => $tableName,
                    ],
                    $force
                );
            }

            $this->components->info('Model created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
