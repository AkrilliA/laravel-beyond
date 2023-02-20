<?php

namespace Tests\Commands;

test('should not delete the app folder when confirmation is yes', function () {
    $this->artisan('beyond:setup')
        ->expectsConfirmation('skip deleting the app folder','yes');

});

test('must delete the app folder when confirmation is no', function () {
    $this->artisan('beyond:setup --force')
        ->expectsConfirmation('skip deleting the app folder','no');

});