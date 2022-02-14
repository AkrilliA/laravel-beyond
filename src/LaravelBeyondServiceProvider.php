<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeControllerCommand;
use Regnerisch\LaravelBeyond\Commands\SetupCommand;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeControllerCommand::class,
                SetupCommand::class,
            ]);
        }
    }
}
