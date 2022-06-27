<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeActionCommand extends Command
{
    protected $signature = 'beyond:make:action {name} {--overwrite=false}';

    protected $description = 'Make a new action';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'action.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Actions') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite,
            );

            $this->info("Action created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
