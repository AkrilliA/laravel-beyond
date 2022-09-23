# Upgrade Guide

- [Upgrade To 4.0 from 3.x](#upgrade-to-40-from-3x)

## Upgrade to 4.0 from 3.x

### Controller moved to Support/Controllers
We moved the controller to the Support/Controllers folder to imrpove compatibility with other packages and decrease boilerplate.

Create a new `Controller.php` in `/src/Support/Controllers`with following content:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
```

Change the namespace of your Controller from `Illuminate\Routing\Controller` to `Support\Controllers\Controller`.