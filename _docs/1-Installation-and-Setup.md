# 1. Installation

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)
    
## Version Compatibility

| Breadcrumbs                              | Laravel                                                                                                             |
|:-----------------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| ![Breadcrumbs v2.x][breadcrumbs_2_x]     | ![Laravel v5.0][laravel_5_0] ![Laravel v5.1][laravel_5_1] ![Laravel v5.2][laravel_5_2] ![Laravel v5.3][laravel_5_3] |
| ![Breadcrumbs v3.0.x][breadcrumbs_3_0_x] | ![Laravel v5.4][laravel_5_4]                                                                                        |
| ![Breadcrumbs v3.1.x][breadcrumbs_3_1_x] | ![Laravel v5.5][laravel_5_5]                                                                                        |
| ![Breadcrumbs v3.2.x][breadcrumbs_3_2_x] | ![Laravel v5.6][laravel_5_6]                                                                                        |
| ![Breadcrumbs v3.3.x][breadcrumbs_3_3_x] | ![Laravel v5.7][laravel_5_7]                                                                                        |
| ![Breadcrumbs v3.4.x][breadcrumbs_3_4_x] | ![Laravel v5.8][laravel_5_8]                                                                                        |
| ![Breadcrumbs v4.0.x][breadcrumbs_4_0_x] | ![Laravel v6.0][laravel_6_0]                                                                                        |

[laravel_5_0]:  https://img.shields.io/badge/v5.0-supported-brightgreen.svg?style=flat-square "Laravel v5.0"
[laravel_5_1]:  https://img.shields.io/badge/v5.1-supported-brightgreen.svg?style=flat-square "Laravel v5.1"
[laravel_5_2]:  https://img.shields.io/badge/v5.2-supported-brightgreen.svg?style=flat-square "Laravel v5.2"
[laravel_5_3]:  https://img.shields.io/badge/v5.3-supported-brightgreen.svg?style=flat-square "Laravel v5.3"
[laravel_5_4]:  https://img.shields.io/badge/v5.4-supported-brightgreen.svg?style=flat-square "Laravel v5.4"
[laravel_5_5]:  https://img.shields.io/badge/v5.5-supported-brightgreen.svg?style=flat-square "Laravel v5.5"
[laravel_5_6]:  https://img.shields.io/badge/v5.6-supported-brightgreen.svg?style=flat-square "Laravel v5.6"
[laravel_5_7]:  https://img.shields.io/badge/v5.7-supported-brightgreen.svg?style=flat-square "Laravel v5.7"
[laravel_5_8]:  https://img.shields.io/badge/v5.8-supported-brightgreen.svg?style=flat-square "Laravel v5.8"
[laravel_6_0]:  https://img.shields.io/badge/v6.0-supported-brightgreen.svg?style=flat-square "Laravel v6.0"

[breadcrumbs_2_x]:   https://img.shields.io/badge/version-2.*-blue.svg?style=flat-square "Breadcrumbs v2.*"
[breadcrumbs_3_0_x]: https://img.shields.io/badge/version-3.0.*-blue.svg?style=flat-square "Breadcrumbs v3.0.*"
[breadcrumbs_3_1_x]: https://img.shields.io/badge/version-3.1.*-blue.svg?style=flat-square "Breadcrumbs v3.1.*"
[breadcrumbs_3_2_x]: https://img.shields.io/badge/version-3.2.*-blue.svg?style=flat-square "Breadcrumbs v3.2.*"
[breadcrumbs_3_3_x]: https://img.shields.io/badge/version-3.3.*-blue.svg?style=flat-square "Breadcrumbs v3.3.*"
[breadcrumbs_3_4_x]: https://img.shields.io/badge/version-3.4.*-blue.svg?style=flat-square "Breadcrumbs v3.4.*"
[breadcrumbs_4_0_x]: https://img.shields.io/badge/version-4.0.*-blue.svg?style=flat-square "Breadcrumbs v4.0.*"

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
