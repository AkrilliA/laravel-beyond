<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeDataTransferObjectCommand extends Command
{
    protected $signature = 'beyond:make:dto {name?} {--overwrite}';

    protected $description = 'Make a new data transfer object';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

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

            $this->info('DataTransferObject created.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
