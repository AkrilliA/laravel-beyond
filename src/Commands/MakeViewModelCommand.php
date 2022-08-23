<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;

class MakeViewModelCommand extends BaseCommand
{
    protected $signature = 'beyond:make:vm {name?} {--overwrite}';

    protected $description = 'Make a new view model';

    protected array $requiredPackages = [
        'spatie/laravel-view-models',
    ];

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = (new AppNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'view-model.stub',
                $schema->path('ViewModels'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            $this->components->info('ViewModel created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
