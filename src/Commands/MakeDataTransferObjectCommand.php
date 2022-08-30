<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;
use Illuminate\Support\Str;

class MakeDataTransferObjectCommand extends BaseCommand
{
    protected $signature = 'beyond:make:dto {name?} {--overwrite} {--factory}';

    protected $description = 'Make a new data transfer object';

    protected array $requiredPackages = [
        'spatie/data-transfer-object',
    ];

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');
            $factory = $this->option('factory');

            $schema = (new DomainNameSchemaResolver($this, $name))->handle();

            beyond_copy_stub(
                'data-transfer-object.stub',
                $schema->path('DataTransferObjects'),
                [
                    '{{ namespace }}' => $schema->namespace(),
                    '{{ className }}' => $schema->className(),
                ],
                $overwrite
            );

            if ($factory) {
                $domainNamespace = $schema->namespace();
                $className = $schema->className();
                $schema = (new AppNameSchemaResolver($this, $className, $domainNamespace))->handle();
                beyond_copy_stub(
                    'data-transfer-object-factory.stub',
                    Str::of(Str::beforeLast($schema->path('DataFactories'), '.php'))
                        ->append('Factory.php'),
                    [
                        '{{ namespace }}' => $schema->namespace(),
                        '{{ className }}' => $className,
                        '{{ domainNamespace }}' => $domainNamespace
                    ],
                    $overwrite
                );
            }

            $this->components->info('DataTransferObject created.');
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }
}
