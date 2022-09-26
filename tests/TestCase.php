<?php

namespace Tests;

use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;
use Regnerisch\LaravelBeyond\LaravelBeyondServiceProvider;
use Regnerisch\LaravelBeyond\Testing\Fakes\ComposerFake;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->swap(ComposerContract::class, new ComposerFake());
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelBeyondServiceProvider::class,
        ];
    }
}
