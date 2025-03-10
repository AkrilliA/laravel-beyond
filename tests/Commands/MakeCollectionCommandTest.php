<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeCollectionCommandTest extends TestCase
{
    public function test_can_make_collection(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_collection_using_force(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:collection User.UserCollection --force');

        $code->assertOk();
    }
}
