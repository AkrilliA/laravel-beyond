<?php

namespace Tests\Commands;

test('can make job', function () {
    $this->artisan('beyond:make:job Admin/User/UserJob');

    expect(base_path().'/src/App/Admin/User/Jobs/UserJob.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
