<?php

namespace Tests\Commands;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;

afterEach(function () {
    (new Filesystem())->cleanDirectory(base_path().'/database');
});

test('can make model', function () {
    $this->artisan('beyond:make:model User/User');

    expect(base_path().'/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make model, factory and migration are created', function () {
    $this->artisan('beyond:make:model User/User --factory --migration');

    expect(base_path().'/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    $date = Carbon::parse()->format('Y_m_d_his');

    expect(base_path()."/database/migrations/{$date}_create_users_table.php")
        ->toBeFile()
        ->toPlaceholdersBeReplaced()
        ->and(base_path().'/database/factories/UserFactory.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});

test('can make model, factory and migration are created using shortcuts', function () {
    $this->artisan('beyond:make:model User/User -mf');

    expect(base_path().'/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    $date = Carbon::parse()->format('Y_m_d_his');

    expect(base_path()."/database/migrations/{$date}_create_users_table.php")
        ->toBeFile()
        ->toPlaceholdersBeReplaced()
        ->and(base_path().'/database/factories/UserFactory.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});
