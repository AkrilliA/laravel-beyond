<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeActionCommand;
use Regnerisch\LaravelBeyond\Commands\MakeControllerCommand;
use Regnerisch\LaravelBeyond\Commands\MakeDataTransferObjectCommand;
use Regnerisch\LaravelBeyond\Commands\MakeModelCommand;
use Regnerisch\LaravelBeyond\Commands\MakePolicyCommand;
use Regnerisch\LaravelBeyond\Commands\MakeQueryCommand;
use Regnerisch\LaravelBeyond\Commands\MakeRequestCommand;
use Regnerisch\LaravelBeyond\Commands\MakeResourceCommand;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeActionCommand::class,
                MakeControllerCommand::class,
                MakeDataTransferObjectCommand::class,
                MakeModelCommand::class,
                MakePolicyCommand::class,
                MakeQueryCommand::class,
                MakeRequestCommand::class,
                MakeResourceCommand::class,
            ]);
        }
    }
}
