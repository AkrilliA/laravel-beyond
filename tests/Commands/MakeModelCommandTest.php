<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeModelCommandTest extends TestCase
{
    public function testCanMakeModel(): void
    {
        $this->artisan('beyond:make:model User.User');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeModelUsingForce(): void
    {
        $this->artisan('beyond:make:model User.User');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:model User.User --force');

        $code->assertOk();
    }
}
