<?php

namespace Regnerisch\LaravelBeyond;

use Illuminate\Support\ServiceProvider;
use Regnerisch\LaravelBeyond\Commands\MakeControllerCommand;

class LaravelBeyondServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeControllerCommand::class
            ]);
        }
    }
}
