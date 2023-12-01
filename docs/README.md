# Laravel Beyond

*This package is inspired by "[Laravel Beyond CRUD](https://spatie.be/products/laravel-beyond-crud)" from Spatie
and "[Modularising the Monolith](https://www.youtube.com/watch?v=0Rq-yHAwYjQ&t=4129s)" from Ryuta Hamasaki.*


This package will help you with `beyond:make` commands to easily create classes inside your "Laravel Beyond CRUD"
inspired application.
We try to implement commands as near as possible on their original `make` counterparts.

In version 7 we completely changed the way how Laravel Beyond works. We now do no longer change Laravels default
directory structure, instead we place the DDD structure inside a separate `modules` directory. This ensures
compatibility with any other (Laravel related) package. 