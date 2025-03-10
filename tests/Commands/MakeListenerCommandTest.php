<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeListenerCommandTest extends TestCase
{
    public function test_can_make_listener(): void
    {
        $this->artisan('beyond:make:listener User.SendShipmentNotification');

        $file = beyond_domain_path('User/Listeners/SendShipmentNotification.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_listener_using_force(): void
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
