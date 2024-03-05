# Upgrade Guide
## Upgrade to 7.x from 6.x
### Directory Structure
### Dropped Commands
We decided to drop following Commands:

- `beyond:make:route`
- `beyond:make:trait`
- `beyond:setup`

### New Command
As we changed the structure we had to introduce a new command:

- `beyond:make:module`

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
