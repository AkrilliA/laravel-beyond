<?php

namespace Tests;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use AkrilliA\LaravelBeyond\LaravelBeyondServiceProvider;
use AkrilliA\LaravelBeyond\Testing\Fakes\ComposerFake;
use Orchestra\Testbench\TestCase as BaseTestCase;

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
