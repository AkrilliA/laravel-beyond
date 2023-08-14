<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeResourceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeResource(): void
    {
        $this->artisan('beyond:make:resource User.UserResource');

        $file = beyond_modules_path('User/App/Resources/UserResource.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
