# Upgrade Guide

- [Upgrade to 6.x from 5.x](#upgrade-to-6x-from-5x)
- [Upgrade to 5.x from 4.x](#upgrade-to-5x-from-4x)
- [Upgrade to 4.x from 3.x](#upgrade-to-4x-from-3x)

## Upgrade to 6.x from 5.x
Please be aware that we removed `regnerisch/laravel-command-hooks`. If you are using this package, please run `composer require regnerisch/laravel-command-hooks`.

## Upgrade to 5.x from 4.x

You need to replace `regnerisch/laravel-beyond` with `akrillia/laravel-beyond` inside your `composer.json`:

```json
"require-dev": {
    //...
    "akrillia/laravel-beyond": "^5.0",
    //...
}
```

## Upgrade to 4.x from 3.x

### Controller moved to Support/Controllers
We moved the controller to the `Support/Controllers` folder to improve compatibility with other packages and decrease boilerplate.

Create a new `Controller.php` in `/src/Support/Controllers`with following content:

```php
<?php

namespace Support\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
```

Change the namespace of your controller from `Illuminate\Routing\Controller` to `Support\Controllers\Controller`.
