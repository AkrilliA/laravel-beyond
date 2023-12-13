<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeNotificationCommandTest extends TestCase
{
    public function testCanMakeNotification(): void
    {
        $this->artisan('beyond:make:notification User.UserCreated');

        $file = beyond_domain_path('User/Notifications/UserCreated.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeNotificationUsingForce(): void
    {
        $this->artisan('beyond:make:notification User.UserCreated');

        $file = beyond_domain_path('User/Notifications/UserCreated.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:notification User.UserCreated');

        $code->assertOk();
    }
}
