<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeMiddlewareCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeMiddleware(): void
    {
        $this->artisan('beyond:make:middleware User.SetLocale');

        $file = beyond_modules_path('User/App/Middleware/SetLocale.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeMiddlewareUsingForce(): void
    {
        $this->artisan('beyond:make:middleware User.SetLocale');

        $file = beyond_modules_path('User/App/Middleware/SetLocale.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:middleware User.SetLocale --force');

        $code->assertOk();
    }
}
