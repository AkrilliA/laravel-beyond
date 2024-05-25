<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeScopeCommandTest extends TestCase
{
    public function testCanMakeScope(): void
    {
        $this->artisan('beyond:make:scope User.ActiveScope');

        $file = beyond_domain_path('User/Scopes/ActiveScope.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeScopeUsingForce(): void
    {
        $this->artisan('beyond:make:scope User.ActiveScope');

        $file = beyond_domain_path('User/Scopes/ActiveScope.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:scope User.ActiveScope --force');

        $code->assertOk();
    }
}
