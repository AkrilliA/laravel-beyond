<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeEventCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeEvent(): void
    {
        $this->artisan('beyond:make:event User.UserCreated');

        $file = beyond_modules_path('User/Domain/Events/UserCreated.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
