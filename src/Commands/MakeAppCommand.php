<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Actions\CopyDirectoryAction;
use AkrilliA\LaravelBeyond\Actions\DeletePathAction;
use AkrilliA\LaravelBeyond\Actions\MoveAndRefactorFileAction;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

final class MakeAppCommand extends Command
{
    protected $signature = 'beyond:make:app {name} {--full} {--force}';

    protected $description = 'Make a new app';

    public function __construct(
        private readonly CopyDirectoryAction $copyDirectoryAction,
        private readonly MoveAndRefactorFileAction $moveAndRefactorFileAction,
        private readonly DeletePathAction $deletePathAction
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $app = Str::of($this->argument('name'))->studly()->ucfirst()->value();
        $force = (bool) $this->option('force');
        $full = (bool) $this->option('full');

        $this->copyDirectoryAction->execute(
            __DIR__.'/../../stubs/App',
            beyond_app_path($app),
            $force,
        );

        $this->moveAndRefactorAppFiles($app, $force);

        $this->deleteGitKeep($app, ! $full);

        $this->components->info("{$app} app created successfully.");
    }

    private function moveAndRefactorAppFiles(string $app, bool $force = false): void
    {
        $files = [
            'Providers/AppAuthServiceProvider.stub'  => "Providers/{$app}AuthServiceProvider.php",
            'Providers/AppEventServiceProvider.stub' => "Providers/{$app}EventServiceProvider.php",
            'Providers/AppRouteServiceProvider.stub' => "Providers/{$app}RouteServiceProvider.php",
            'Providers/AppServiceProvider.stub'      => "Providers/{$app}ServiceProvider.php",
            'routes.stub'                            => 'routes.php',
        ];

        foreach ($files as $from => $to) {
            $this->moveAndRefactorFileAction->execute(
                beyond_app_path("$app/$from"),
                beyond_app_path("$app/$to"),
                [
                    '{{ module }}' => $app,
                ],
                $force
            );
        }
    }

    private function deleteGitKeep(string $app, bool $minimal = false): void
    {
        $files = Finder::create()
            ->files()
            ->ignoreDotFiles(false)
            ->name('.gitkeep')
            ->in(beyond_app_path($app));

        foreach ($files as $file) {
            $this->deletePathAction->execute(
                $minimal
                    ? $file->getPath()
                    : $file->getPathname()
            );
        }
    }
}
