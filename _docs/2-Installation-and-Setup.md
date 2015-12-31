# 2. Installation

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/breadcrumbs`.

Or by adding the package to your `composer.json`.

```json
{
    "require": {
        "arcanedev/breadcrumbs": "~2.4"
    }
}
```

Then install it via `composer install` or `composer update`.

## Laravel

### Setup

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class,
],
```

And for the Facade:

```php
// config/app.php

'aliases' => [
    ...
    'Breadcrumbs' => Arcanedev\Breadcrumbs\Facades\Breadcrumbs::class,
];
```

### Artisan commands

To publish the config &amp; view files, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider"
```
