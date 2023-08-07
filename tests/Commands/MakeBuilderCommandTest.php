<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeBuilderCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeAction(): void
    {
        $this->artisan('beyond:make:builder User.UserBuilder');

        $file = beyond_modules_path('User/Domain/Builders/UserBuilder.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
