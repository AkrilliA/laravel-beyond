<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Commands\Abstracts\DomainCommand;
use AkrilliA\LaravelBeyond\NameResolver;
use Illuminate\Support\Str;

class MakeModelCommand extends DomainCommand
{
    protected $signature = 'beyond:make:model {name} {--f|factory} {--m|migration} {--force}';

    protected $description = 'Make a new model';

    protected function getStub(): string
    {
        return 'model.stub';
    }

    public function getType(): string
    {
        return 'Model';
    }

    public function setup(NameResolver $nameResolver): void
    {
        $this->addOnSuccess(function (string $namespace, string $className) use ($nameResolver) {
            $force = (bool) $this->option('force');

            $module = $nameResolver->getModule();

            if ($this->option('migration')) {
                $tableName = Str::snake(Str::pluralStudly($className));
                $fileName = now()->format('Y_m_d_His').'_create_'.$tableName.'_table';

                beyond_copy_stub(
                    'migration.create.stub',
                    base_path()."/modules/$module/Infrastructure/migrations/$fileName.php",
                    [
                        '{{ table }}' => $tableName,
                    ],
                    $force
                );
            }

            if ($this->option('factory')) {
                $fileName = $className.'Factory';

                beyond_copy_stub(
                    'factory.stub',
                    base_path()."/modules/$module/Infrastructure/factories/$fileName.php",
                    [
                        '{{ namespace }}' => $namespace,
                        '{{ model }}'     => $fileName,
                    ],
                    $force
                );
            }
        });
    }
}
