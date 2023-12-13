<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeQueryCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:app User');
    }

    public function testCanMakeQuery(): void
    {
        $this->artisan('beyond:make:query User.UserIndexQuery');

        $file = beyond_app_path('User/Queries/UserIndexQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeQueryUsingForce(): void
    {
        $this->artisan('beyond:make:query User.UserIndexQuery');

        $file = beyond_app_path('User/Queries/UserIndexQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:query User.UserIndexQuery --force');

        $code->assertOk();
    }

    public function testCanMakeQueryWithModel(): void
    {
        $this->artisan('beyond:make:query User.UserIndexQuery --model=User');

        $file = beyond_app_path('User/Queries/UserIndexQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeQueryWithModelUsingForce(): void
    {
        $this->artisan('beyond:make:query User.UserIndexQuery --model=User');

        $file = beyond_app_path('User/Queries/UserIndexQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:query User.UserIndexQuery --model=User --force');

        $code->assertOk();
    }
}
