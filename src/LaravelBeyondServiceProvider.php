<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeActionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeBuilderCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCollectionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCommand;
use Regnerisch\LaravelBeyond\Commands\MakeCommandCommand;
use Regnerisch\LaravelBeyond\Commands\MakeControllerCommand;
use Regnerisch\LaravelBeyond\Commands\MakeDataTransferObjectCommand;
use Regnerisch\LaravelBeyond\Commands\MakeEnumCommand;
use Regnerisch\LaravelBeyond\Commands\MakeEventCommand;
use Regnerisch\LaravelBeyond\Commands\MakeJobCommand;
use Regnerisch\LaravelBeyond\Commands\MakeListenerCommand;
use Regnerisch\LaravelBeyond\Commands\MakeMiddlewareCommand;
use Regnerisch\LaravelBeyond\Commands\MakeModelCommand;
use Regnerisch\LaravelBeyond\Commands\MakePolicyCommand;
use Regnerisch\LaravelBeyond\Commands\MakeQueryCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRequestCommand;
use Regnerisch\LaravelBeyond\Commands\MakeResourceCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRouteCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRuleCommand;
use Regnerisch\LaravelBeyond\Commands\MakeServiceProviderCommand;
use Regnerisch\LaravelBeyond\Commands\SetupCommand;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCommand::class,
                MakeActionCommand::class,
                MakeCollectionCommand::class,
                MakeCommandCommand::class,
                MakeControllerCommand::class,
                MakeDataTransferObjectCommand::class,
                MakeEnumCommand::class,
                MakeEventCommand::class,
                MakeJobCommand::class,
                MakeListenerCommand::class,
                MakeMiddlewareCommand::class,
                MakeModelCommand::class,
                MakePolicyCommand::class,
                MakeBuilderCommand::class,
                MakeQueryCommand::class,
                MakeRequestCommand::class,
                MakeResourceCommand::class,
                MakeRouteCommand::class,
                MakeRuleCommand::class,
                MakeServiceProviderCommand::class,
                SetupCommand::class,
            ]);
        }
    }
}
