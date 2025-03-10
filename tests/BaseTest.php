<?php

namespace Tests;

class BaseTest extends TestCase
{
    public function test_path_helpers(): void
    {
        $this->assertEquals(base_path('src'), beyond_path());
        $this->assertEquals(beyond_path('Application'), beyond_app_path());
        $this->assertEquals(beyond_path('Domain'), beyond_domain_path());
        $this->assertEquals(beyond_path('Support'), beyond_support_path());
    }

    public function test_can_make_class_with_directory(): void
    {
        $this->artisan('beyond:make:action User.Admin/UserStoreAction');

        $file = beyond_domain_path('User/Actions/Admin/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_class_with_deep_directory(): void
    {
        $this->artisan('beyond:make:action User.Admin/SuperAdmin/UserStoreAction');

        $file = beyond_domain_path('User/Actions/Admin/SuperAdmin/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
