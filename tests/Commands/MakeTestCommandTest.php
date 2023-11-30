<?php

namespace Commands;

use Tests\TestCase;

class MakeTestCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeTest(): void
    {
        $this->artisan('beyond:make:test User.UserTest');

        $file = beyond_modules_path('User/Tests/Feature/UserTest.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeUnitTest(): void
    {
        $this->artisan('beyond:make:test User.UserTest --unit');

        $file = beyond_modules_path('User/Tests/Unit/UserTest.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakePestTest(): void
    {
        $this->artisan('beyond:make:test User.UserTest --pest');

        $file = beyond_modules_path('User/Tests/Feature/UserTest.php');

        $this->assertFileExists($file);
    }

    public function testCanMakePestUnitTest(): void
    {
        $this->artisan('beyond:make:test User.UserTest --pest --unit');

        $file = beyond_modules_path('User/Tests/Unit/UserTest.php');

        $this->assertFileExists($file);
    }
}
