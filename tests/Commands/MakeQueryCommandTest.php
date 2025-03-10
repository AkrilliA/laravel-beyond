<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeQueryCommandTest extends TestCase
{
    public function test_can_make_query(): void
    {
        $this->artisan('beyond:make:query User.IndexUserQuery');

        $file = beyond_app_path('User/Queries/IndexUserQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_query_using_force(): void
    {
        $this->artisan('beyond:make:query User.IndexUserQuery');

        $file = beyond_app_path('User/Queries/IndexUserQuery.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:query User.IndexUserQuery --force');

        $code->assertOk();
    }
}
