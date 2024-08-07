<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeServiceProviderCommandTest extends TestCase
{
    public function testCanMakeProvider(): void
    {
        $this->artisan('beyond:make:provider UserServiceProvider');

        $file = beyond_support_path('Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Providers', $contents);
        $this->assertClassName('UserServiceProvider', $contents);
    }

    public function testCanMakeProviderUsingForce(): void
    {
        $this->artisan('beyond:make:provider UserServiceProvider');

        $file = beyond_support_path('Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);

        $code = $this->artisan('beyond:make:provider UserServiceProvider --force');

        $code->assertOk();
    }
}
