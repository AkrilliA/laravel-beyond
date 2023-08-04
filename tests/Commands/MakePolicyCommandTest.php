<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakePolicyCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakePolicy(): void
    {
        $this->artisan('beyond:make:policy User/UserPolicy');

        $file = beyond_modules_path('User/Domain/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakePolicyWithModel(): void
    {
        $this->artisan('beyond:make:policy User/UserPolicy --model=User');

        $file = beyond_modules_path('User/Domain/Policies/UserPolicy.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringNotContainsString('{{ modelNamespace }}', $contents);
        $this->assertStringNotContainsString('{{ modelClassName }}', $contents);
        $this->assertStringNotContainsString('{{ modelVariable }}', $contents);
    }
}
