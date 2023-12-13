<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeBuilderCommandTest extends TestCase
{
    public function testCanMakeBuilder(): void
    {
        $this->artisan('beyond:make:builder User.UserBuilder');

        $file = beyond_domain_path('User/Builders/UserBuilder.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeBuilderUsingForce(): void
    {
        $this->artisan('beyond:make:builder User.UserBuilder');

        $file = beyond_domain_path('User/Builders/UserBuilder.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:builder User.UserBuilder --force');

        $code->assertOk();
    }
}
