<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeEventCommandTest extends TestCase
{
    public function testCanMakeEvent(): void
    {
        $this->artisan('beyond:make:event User.UserCreated');

        $file = beyond_domain_path('User/Events/UserCreated.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeEventUsingForce(): void
    {
        $this->artisan('beyond:make:event User.UserCreated');

        $file = beyond_domain_path('User/Events/UserCreated.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:event User.UserCreated --force');

        $code->assertOk();
    }
}
