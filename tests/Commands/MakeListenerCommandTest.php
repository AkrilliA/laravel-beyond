<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeListenerCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeListener(): void
    {
        $this->artisan('beyond:make:listener User.SendShipmentNotification');

        $file = beyond_modules_path('User/Domain/Listeners/SendShipmentNotification.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
