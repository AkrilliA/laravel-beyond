<?php

namespace AkrilliA\LaravelBeyond\Commands;

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

    public function onSuccess(string $namespace, string $className)
    {
        $name = $this->argument('name');
        $force = $this->option('force');

        $module = $this->getFQN()->getModule();

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
                    '{{ model }}' => $fileName,
                ],
                $force
            );
        }
    }
}
