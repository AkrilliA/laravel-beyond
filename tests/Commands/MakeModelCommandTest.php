<?php

namespace Tests\Commands;

use Carbon\Carbon;

test('can make model', function () {
    $this->artisan('beyond:make:model User/User');

    expect(base_path() . '/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make model and migration is created', function () {
    $this->artisan('beyond:make:model User/User --migration --overwrite');

    expect(base_path() . '/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    $date = Carbon::parse()->format('Y_m_d_his');

    expect(base_path() . "/database/migrations/{$date}_create_users_table.php")
        ->toBeFile();
});
