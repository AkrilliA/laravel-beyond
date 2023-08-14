<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeRuleCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeResource(): void
    {
        $this->artisan('beyond:make:rule User.UniqueUser');

        $file = beyond_modules_path('User/App/Rules/UniqueUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
