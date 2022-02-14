<?php

namespace Regnerisch\LaravelBeyond\Commands;

use Illuminate\Console\Command;
use Regnerisch\LaravelBeyond\Actions\MoveAndRefactorFileAction;

class SetupCommand extends Command
{
    protected $signature = 'beyond:setup {directory=src}';

    protected $description = '';

    public function __construct(
        protected MoveAndRefactorFileAction $moveAndRefactorFileAction
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Console/Kernel.php',
            base_path() . '/src/App/Console/Kernel.php'
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Exceptions/Handler.php',
            base_path() . '/src/App/Exceptions/Handler.php',
        );

        $this->moveMiddlewares();

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Http/Kernel.php',
            base_path() . '/src/App/HttpKernel.php',
            [
                'namespace App\Http;' => 'namespace App;',
                'use Illuminate\Foundation\Http\Kernel as HttpKernel;' => 'use Illuminate\Foundation\Http\Kernel;',
                'class Kernel extends HttpKernel' => 'class HttpKernel extends Kernel',
                '\App\Http\Middleware\\' => '\Support\Middlewares\\',
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Models/User.php',
            base_path() . '/src/Domain/Users/Models/User.php',
            [
                'namespace App\Models;' => 'namespace Domain\Users\Models;',
            ]
        );

        $this->moveProviders();

        $this->changeComposerAutoloader();
    }

    protected function moveMiddlewares(): void
    {
        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/Authenticate.php',
            app_path() . '/../src/Support/Middlewares/Authenticate.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/EncryptCookies.php',
            app_path() . '/../src/Support/Middlewares/EncryptCookies.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/PreventRequestsDuringMaintenance.php',
            app_path() . '/../src/Support/Middlewares/PreventRequestsDuringMaintenance.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/RedirectIfAuthenticated.php',
            app_path() . '/../src/Support/Middlewares/RedirectIfAuthenticated.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/TrimStrings.php',
            app_path() . '/../src/Support/Middlewares/TrimStrings.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/TrustHosts.php',
            app_path() . '/../src/Support/Middlewares/TrustHosts.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            app_path() . '/Http/Middleware/TrustProxies.php',
            app_path() . '/../src/Support/Middlewares/TrustProxies.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Http/Middleware/VerifyCsrfToken.php',
            base_path() . '/src/Support/Middlewares/VerifyCsrfToken.php',
            [
                'namespace App\Http\Middleware;' => 'namespace Support\Middlewares;'
            ]
        );
    }

    protected function moveProviders(): void
    {
        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Providers/AppServiceProvider.php',
            base_path() . '/src/App/Providers/AppServiceProvider.php',
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Providers/AuthServiceProvider.php',
            base_path() . '/src/App/Providers/AuthServiceProvider.php',
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Providers/BroadcastServiceProvider.php',
            base_path() . '/src/App/Providers/BroadcastServiceProvider.php',
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Providers/EventServiceProvider.php',
            base_path() . '/src/App/Providers/EventServiceProvider.php',
        );

        $this->moveAndRefactorFileAction->execute(
            base_path() . '/app/Providers/RouteServiceProvider.php',
            base_path() . '/src/App/Providers/RouteServiceProvider.php',
        );
    }

    protected function changeComposerAutoloader(): void
    {
        $array = json_decode(file_get_contents(app_path() . '/../composer.json'), true);

        $psr4 = $array['autoload']['psr-4'];
        $psr4['App\\'] = 'src/App/';
        $psr4['Domain\\'] = 'src/Domain/';
        $psr4['Support\\'] = 'src/Support/';
        $array['autoload']['psr-4'] = $psr4;

        file_put_contents(
            app_path() . '/../composer.json',
            json_encode($array)
        );
    }
}
