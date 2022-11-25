<?php

namespace AkrilliA\LaravelBeyond\Commands;

use AkrilliA\LaravelBeyond\Actions\ChangeComposerAutoloaderAction;
use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorDirectoryAction;
use AkrilliA\LaravelBeyond\Actions\CopyAndRefactorFileAction;
use AkrilliA\LaravelBeyond\Actions\DeleteAction;
use AkrilliA\LaravelBeyond\Actions\RefactorFileAction;
use Illuminate\Filesystem\Filesystem;

class SetupCommand extends BaseCommand
{
    protected $signature = 'beyond:setup {--skip-delete} {--force}';

    protected $description = '';

    public function __construct(
        protected CopyAndRefactorFileAction $copyAndRefactorFileAction,
        protected CopyAndRefactorDirectoryAction $copyAndRefactorDirectoryAction,
        protected RefactorFileAction $refactorFileAction,
        protected ChangeComposerAutoloaderAction $changeComposerAutoloaderAction,
        protected DeleteAction $deleteAction,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $skipDelete = $this->option('skip-delete');
            $force = $this->option('force');

            // Console
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Console/Kernel.php',
                base_path().'/src/App/Console/Kernel.php',
                force: $force
            );

            // Exceptions
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Exceptions/Handler.php',
                base_path().'/src/App/Exceptions/Handler.php',
                force: $force
            );

            // Controller
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Http/Controllers/Controller.php',
                base_path().'/src/Support/Controllers/Controller.php',
                [
                    'namespace App\Http\Controllers;' => 'namespace Support\Controllers;',
                ],
                $force
            );

            // Middlewares
            $this->moveMiddlewares($force);

            // Http Kernel
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Http/Kernel.php',
                base_path().'/src/App/HttpKernel.php',
                [
                    'namespace App\Http;' => 'namespace App;',
                    'use Illuminate\Foundation\Http\Kernel as HttpKernel;' => 'use Illuminate\Foundation\Http\Kernel;',
                    'class Kernel extends HttpKernel' => 'class HttpKernel extends Kernel',
                    '\App\Http\Middleware\\' => '\Support\Middlewares\\',
                ],
                $force
            );

            // Application
            beyond_copy_stub(
                'application.stub',
                base_path().'/src/App/Application.php',
                force: $force
            );

            // Models
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Models/User.php',
                base_path().'/src/Domain/Users/Models/User.php',
                [
                    'namespace App\Models;' => 'namespace Domain\Users\Models;',
                ],
                $force
            );

            // Providers
            $this->moveProviders($force);

            // Bootstrap
            $this->prepareBootstrap();

            // Rewrite configs
            $this->refactorFileAction->execute(
                base_path().'/config/auth.php',
                [
                    'App\Models\User::class' => 'Domain\Users\Models\User::class',
                ]
            );

            // Composer Autoloader
            $this->changeComposerAutoloaderAction->execute();

            if (! $skipDelete) {
                // Delete app folder
                $this->deleteAction->execute(base_path().'/app');
            }

            $this->components->info('Setup completed.');
            $this->components->info(
                'Do not forget to add following code into the boot() function of your AppServiceProvider:'.PHP_EOL.PHP_EOL.

                'Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(function (string $modelName) {'.PHP_EOL.
                "\t".'return \'Database\\\Factories\\\' . class_basename($modelName) . \'Factory\';'.PHP_EOL.
                '});'.PHP_EOL
            );
        } catch (\Exception $exception) {
            $this->components->error($exception->getMessage());
        }
    }

    protected function moveMiddlewares(bool $force = false): void
    {
        $this->copyAndRefactorDirectoryAction->execute(
            base_path().'/app/Http/Middleware',
            base_path().'/src/Support/Middlewares',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;',
            ],
            $force
        );
    }

    protected function moveProviders(bool $force = false): void
    {
        $fs = new Filesystem();
        $providers = $fs->files(base_path().'/app/Providers');

        foreach ($providers as $provider) {
            $this->copyAndRefactorFileAction->execute(
                base_path().'/app/Providers/'.$provider->getFilename(),
                base_path().'/src/App/Providers/'.$provider->getFilename(),
                force: $force
            );
        }
    }

    protected function prepareBootstrap(): void
    {
        $this->refactorFileAction->execute(
            base_path().'/bootstrap/app.php',
            [
                'new Illuminate\Foundation\Application' => 'new App\Application',
                'App\Http\Kernel::class' => 'App\HttpKernel::class',
            ]
        );
    }
}
