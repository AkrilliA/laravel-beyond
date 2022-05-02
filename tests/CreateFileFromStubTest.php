<?php

test('creates an action from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'action.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates an application from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'application.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a plain collection from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'collection.plain.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a collection from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'collection.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a command from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'command.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates an api controller from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'controller.api.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a controller from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'controller.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a dto from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'data-transfer-object.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a job from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'job.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a model from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'model.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates an plain policy from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'policy.plain.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a policy from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'policy.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a query from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'query.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a plain query builder from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'query-builder.plain.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a query builder from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'query-builder.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a request from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'request.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a resource collection from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'resource.collection.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a resource from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'resource.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a route from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'routes.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

test('creates a service provider from stub', function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $stub = 'service-provider.stub';

    $path = beyond_path() . "/tests/files/{$stub}";
    beyond_copy_stub($stub, $path);

    expect($fs->exists($path))->toBeTrue();
});

afterEach(function () {
    $fs = new \Illuminate\Filesystem\Filesystem();
    $path = beyond_path() . "/tests/files";
    $fs->deleteDirectory($path);
});
