<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeListenerCommandTest extends TestCase
{
    public function testCanMakeListener(): void
    {
        $this->artisan('beyond:make:listener User.SendShipmentNotification');

        $file = beyond_domain_path('User/Listeners/SendShipmentNotification.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeListenerUsingForce(): void
    {
        $this->artisan('beyond:make:listener User.SendShipmentNotification');

        $file = beyond_domain_path('User/Listeners/SendShipmentNotification.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:listener User.SendShipmentNotification --force');

        $code->assertOk();
    }
}
