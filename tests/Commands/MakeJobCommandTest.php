<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make job', function () {
    $this->artisan('beyond:make:job User/UserJob');

    expect(base_path().'/modules/User/App/Jobs/UserJob.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
