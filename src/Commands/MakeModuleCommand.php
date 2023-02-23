<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Actions\CreateDirectoryAction;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeModuleCommand extends Command
{
    protected $signature = 'beyond:make:module {name} {--force}';

    protected $description = 'Make a new module';

    public function handle(): void
    {
        $name = Str::of($this->argument('name'))->ucfirst()->value();
        $force = $this->option('force') ?? false;

        $this->createDirectories($name);

        $this->createProviders($name, $force);

        $this->components->info("Module [$name] created.");
    }

    protected function createDirectories(string $name): void
    {
        $directories = [
            $name,
            "$name/App",
            "$name/Domain",
            "$name/Infrastructure",
        ];

        (new CreateDirectoryAction())->execute($directories);
    }

    protected function createProviders(string $name, bool $force = false): void
    {
        $classNames = ['ServiceProvider', 'EventServiceProvider', 'RouteServiceProvider'];
        $namespace = "Modules\\$name";

        foreach ($classNames as $className) {
            beyond_copy_stub(
                'service.provider.stub',
                base_path()."/modules/$name/".$name.$className.'.php',
                [
                    '{{ namespace }}' => $namespace,
                    '{{ className }}' => $name.$className,
                ],
                $force
            );
        }
    }
}
