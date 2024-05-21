<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeRuleCommandTest extends TestCase
{
    public function testCanMakeRule(): void
    {
        $this->artisan('beyond:make:rule User.UniqueUser');

        $file = beyond_app_path('User/Rules/UniqueUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeRuleUsingForce(): void
    {
        $this->artisan('beyond:make:rule User.UniqueUser');

        $file = beyond_app_path('User/Rules/UniqueUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:rule User.UniqueUser --force');

        $code->assertOk();
    }
}
