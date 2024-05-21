<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakePolicyCommandTest extends TestCase
{
    public function testCanMakePolicy(): void
    {
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_app_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakePolicyUsingForce(): void
    {
        $this->artisan('beyond:make:policy User.UserPolicy');

        $file = beyond_app_path('User/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:policy User.UserPolicy --force');

        $code->assertOk();
    }
}
