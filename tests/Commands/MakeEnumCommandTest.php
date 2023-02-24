<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make enum', function () {
    $this->artisan('beyond:make:enum User/UserStatusEnum');

    expect(base_path().'/modules/User/Domain/Enums/UserStatusEnum.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
