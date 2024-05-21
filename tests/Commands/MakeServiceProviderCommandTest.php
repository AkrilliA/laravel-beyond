<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeServiceProviderCommandTest extends TestCase
{
    public function testCanMakeProvider(): void
    {
        $this->artisan('beyond:make:provider User.UserServiceProvider');

        $file = beyond_app_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }

    public function testCanMakeProviderUsingForce(): void
    {
        $this->artisan('beyond:make:provider User.UserServiceProvider');

        $file = beyond_app_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);

        $code = $this->artisan('beyond:make:provider User.UserServiceProvider --force');

        $code->assertOk();
    }
}
