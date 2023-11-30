<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeProcessCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeAction(): void
    {
        $this->artisan('beyond:make:process User.AdminStoreUserProcess');

        $file = beyond_modules_path('User/App/Processes/AdminStoreUserProcess.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeActionUsingForce(): void
    {
        $this->artisan('beyond:make:process User.AdminStoreUserProcess');

        $file = beyond_modules_path('User/App/Processes/AdminStoreUserProcess.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:process User.AdminStoreUserProcess --force');

        $code->assertOk();
    }
}
