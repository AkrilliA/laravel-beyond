<?php

test('resolve app name correctly', function () {
    $appName = 'App';
    $moduleName = 'Testing';
    $className = 'TestClass';

    $appNameSchema = "{$appName}/{$moduleName}/{$className}";

    $appNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver($appNameSchema);

    expect($appNameSchemaResolver->getAppName())->toBe($appName);
    expect($appNameSchemaResolver->getModuleName())->toBe($moduleName);
    expect($appNameSchemaResolver->getClassName())->toBe($className);
});

test('resolve app name missing app name', function () {
    $moduleName = 'Testing';
    $className = 'TestClass';

    $appNameSchema = "{$moduleName}/{$className}";

    try {
        $appNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver($appNameSchema);
    } catch(\Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException $exception) {
        expect($exception->getMessage())->toBe('Invalid name schema! Please ensure the required schema: {App}/{Module}/{ClassName}.');
    }
});

test('resolve app name missing module name', function () {
    $appName = 'App';
    $className = 'TestClass';

    $appNameSchema = "{$appName}/{$className}";

    try {
        $appNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver($appNameSchema);
    } catch(\Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException $exception) {
        expect($exception->getMessage())->toBe('Invalid name schema! Please ensure the required schema: {App}/{Module}/{ClassName}.');
    }
});

test('resolve app name missing class name', function () {
    $appName = 'App';
    $moduleName = 'Testing';

    $appNameSchema = "{$appName}/{$moduleName}";

    try {
        $appNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\AppNameSchemaResolver($appNameSchema);
    } catch(\Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException $exception) {
        expect($exception->getMessage())->toBe('Invalid name schema! Please ensure the required schema: {App}/{Module}/{ClassName}.');
    }
});

test('resolve domain name correctly', function () {
    $domainName = 'Testing';
    $className = 'TestClass';

    $appNameSchema = "{$domainName}/{$className}";

    $appNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver($appNameSchema);

    expect($appNameSchemaResolver->getDomainName())->toBe($domainName);
    expect($appNameSchemaResolver->getClassName())->toBe($className);
});

test('resolve domain name missing domain name', function () {
    $className = 'TestClass';

    $appNameSchema = "{$className}";

    try {
        $domainNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver($appNameSchema);
    } catch (\Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException $exception) {
        expect($exception->getMessage())->toBe('Invalid name schema! Please ensure the required schema: {Domain}/{ClassName}.');
    }
});

test('resolve domain name missing class name', function () {
    $domainName = 'Testing';

    $appNameSchema = "{$domainName}";

    try {
        $domainNameSchemaResolver = new \Regnerisch\LaravelBeyond\Resolvers\DomainNameSchemaResolver($appNameSchema);
    } catch (\Regnerisch\LaravelBeyond\Exceptions\InvalidNameSchemaException $exception) {
        expect($exception->getMessage())->toBe('Invalid name schema! Please ensure the required schema: {Domain}/{ClassName}.');
    }
});
