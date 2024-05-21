<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeMiddlewareCommandTest extends TestCase
{
    public function testCanMakeMiddleware(): void
    {
        $this->artisan('beyond:make:middleware User.SetLocale');

        $file = beyond_app_path('User/Middleware/SetLocale.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeMiddlewareUsingForce(): void
    {
        $this->artisan('beyond:make:middleware User.SetLocale');

        $file = beyond_app_path('User/Middleware/SetLocale.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:middleware User.SetLocale --force');

        $code->assertOk();
    }
}
