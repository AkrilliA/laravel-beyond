<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeEnumCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeEnum(): void
    {
        $this->artisan('beyond:make:enum User.UserType');

        $file = beyond_modules_path('User/Domain/Enums/UserType.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
