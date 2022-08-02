<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Regnerisch\LaravelBeyond\LaravelBeyondServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelBeyondServiceProvider::class,
        ];
    }
}
