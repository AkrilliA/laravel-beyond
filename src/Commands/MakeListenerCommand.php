<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver;

class MakeListenerCommand extends Command
{
    protected $signature = 'beyond:make:listener {name} {--overwrite}';

    protected $description = 'Make a new listener';

    public function handle(): void
    {
        try {
            $name = $this->argument('name');
            $overwrite = $this->option('overwrite');

            $schema = new DomainNameSchemaResolver($name);

            beyond_copy_stub(
                'listener.stub',
                base_path() . '/src/Domain/' . $schema->getPath('Listeners') . '.php',
                [
                    '{{ domain }}' => $schema->getDomainName(),
                    '{{ className }}' => $schema->getClassName(),
                ],
                $overwrite
            );

            $this->info("Listener created.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
