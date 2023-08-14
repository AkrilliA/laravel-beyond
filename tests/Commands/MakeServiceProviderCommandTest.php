<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeServiceProviderCommandTest extends TestCase
{
    public function testCanMakeResource(): void
    {
        $this->artisan('beyond:make:provider UserServiceProvider');

        $file = beyond_modules_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }
}
