<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeModelCommand extends Command
{
    protected $signature = 'beyond:make:model {name} {-m|--migration} {--overwrite=false}';

    protected $description = 'Make a new model';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'model.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Models') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite
            );

            if ($this->option('migration')) {
                $tableName = Str::snake(Str::pluralStudly($schema->getClassName()));
                $fileName = now()->format('Y_m_d_his') . '_create_' . $tableName . '_table';

                beyond_copy_stub(
                    'migration.stub',
                    base_path() . '/database/migrations' . $fileName . '.php',
                    [
                        '{{ tableName }}' => $tableName
                    ],
                    $overwrite
                );
            }

            $this->info("Model created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
