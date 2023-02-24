<?php

namespace Tests;

use AkrilliA\LaravelBeyond\LaravelBeyondServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelBeyondServiceProvider::class,
        ];
    }
}
