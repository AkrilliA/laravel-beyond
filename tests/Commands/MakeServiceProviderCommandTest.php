<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeServiceProviderCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeProvider(): void
    {
        $this->artisan('beyond:make:provider User.UserServiceProvider');

        $file = beyond_modules_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }
}
