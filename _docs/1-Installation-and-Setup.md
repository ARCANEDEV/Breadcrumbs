# 1. Installation

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)
    
## Version Compatibility

| Laravel                      | Breadcrumbs                              |
|:-----------------------------|:-----------------------------------------|
| ![Laravel v8.x][laravel_8_x] | ![Breadcrumbs v6.x][breadcrumbs_6_x]     |
| ![Laravel v7.x][laravel_7_x] | ![Breadcrumbs v5.x][breadcrumbs_5_x]     |
| ![Laravel v6.x][laravel_6_x] | ![Breadcrumbs v4.x][breadcrumbs_4_x]     |
| ![Laravel v5.8][laravel_5_8] | ![Breadcrumbs v3.4.x][breadcrumbs_3_4_x] |
| ![Laravel v5.7][laravel_5_7] | ![Breadcrumbs v3.3.x][breadcrumbs_3_3_x] |
| ![Laravel v5.6][laravel_5_6] | ![Breadcrumbs v3.2.x][breadcrumbs_3_2_x] |
| ![Laravel v5.5][laravel_5_5] | ![Breadcrumbs v3.1.x][breadcrumbs_3_1_x] |
| ![Laravel v5.4][laravel_5_4] | ![Breadcrumbs v3.0.x][breadcrumbs_3_0_x] |
| ![Laravel v5.3][laravel_5_3] | ![Breadcrumbs v2.x][breadcrumbs_2_x]     |
| ![Laravel v5.2][laravel_5_2] | ![Breadcrumbs v2.x][breadcrumbs_2_x]     |
| ![Laravel v5.1][laravel_5_1] | ![Breadcrumbs v2.x][breadcrumbs_2_x]     |
| ![Laravel v5.0][laravel_5_0] | ![Breadcrumbs v2.x][breadcrumbs_2_x]     |

[laravel_8_x]:  https://img.shields.io/badge/version-8.x-blue.svg?style=flat-square "Laravel v8.x"
[laravel_7_x]:  https://img.shields.io/badge/version-7.x-blue.svg?style=flat-square "Laravel v7.x"
[laravel_6_x]:  https://img.shields.io/badge/version-6.x-blue.svg?style=flat-square "Laravel v6.x"
[laravel_5_8]:  https://img.shields.io/badge/version-5.8-blue.svg?style=flat-square "Laravel v5.8"
[laravel_5_7]:  https://img.shields.io/badge/version-5.7-blue.svg?style=flat-square "Laravel v5.7"
[laravel_5_6]:  https://img.shields.io/badge/version-5.6-blue.svg?style=flat-square "Laravel v5.6"
[laravel_5_5]:  https://img.shields.io/badge/version-5.5-blue.svg?style=flat-square "Laravel v5.5"
[laravel_5_4]:  https://img.shields.io/badge/version-5.4-blue.svg?style=flat-square "Laravel v5.4"
[laravel_5_3]:  https://img.shields.io/badge/version-5.3-blue.svg?style=flat-square "Laravel v5.3"
[laravel_5_2]:  https://img.shields.io/badge/version-5.2-blue.svg?style=flat-square "Laravel v5.2"
[laravel_5_1]:  https://img.shields.io/badge/version-5.1-blue.svg?style=flat-square "Laravel v5.1"
[laravel_5_0]:  https://img.shields.io/badge/version-5.0-blue.svg?style=flat-square "Laravel v5.0"

[breadcrumbs_6_x]:   https://img.shields.io/badge/version-6.x-blue.svg?style=flat-square "Breadcrumbs v6.x"
[breadcrumbs_5_x]:   https://img.shields.io/badge/version-5.x-blue.svg?style=flat-square "Breadcrumbs v5.x"
[breadcrumbs_4_x]:   https://img.shields.io/badge/version-4.x-blue.svg?style=flat-square "Breadcrumbs v4.x"
[breadcrumbs_3_4_x]: https://img.shields.io/badge/version-3.4.x-blue.svg?style=flat-square "Breadcrumbs v3.4.x"
[breadcrumbs_3_3_x]: https://img.shields.io/badge/version-3.3.x-blue.svg?style=flat-square "Breadcrumbs v3.3.x"
[breadcrumbs_3_2_x]: https://img.shields.io/badge/version-3.2.x-blue.svg?style=flat-square "Breadcrumbs v3.2.x"
[breadcrumbs_3_1_x]: https://img.shields.io/badge/version-3.1.x-blue.svg?style=flat-square "Breadcrumbs v3.1.x"
[breadcrumbs_3_0_x]: https://img.shields.io/badge/version-3.0.x-blue.svg?style=flat-square "Breadcrumbs v3.0.x"
[breadcrumbs_2_x]:   https://img.shields.io/badge/version-2.x-blue.svg?style=flat-square "Breadcrumbs v2.x"

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/breadcrumbs`.

## Laravel

### Setup

> **NOTE :** The package will automatically register itself if you're using Laravel `>= v5.5`, so you can skip this section.

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
// config/app.php

'providers' => [
    ...
    Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class,
],
```

### Artisan commands

To publish the config &amp; view files, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider"
```
