# 2. Configuration

## Table of contents

  1. [Installation and Setup](1-Installation-and-Setup.md)
  2. [Configuration](2-Configuration.md)
  3. [Usage](3-Usage.md)

```php
<?php

return [

    /* -----------------------------------------------------------------
     |  Template
     | -----------------------------------------------------------------
     */

    'template'  => [

        'default'   => Arcanedev\Breadcrumbs\Breadcrumbs::DEFAULT_TEMPLATE,

        'supported' => [
            // Twitter Bootstrap
            'bootstrap-3'  => 'breadcrumbs::bootstrap-3',
            'bootstrap-4'  => 'breadcrumbs::bootstrap-4',

            // Zurb Foundation
            'foundation-5' => 'breadcrumbs::foundation-5',
            'foundation-6' => 'breadcrumbs::foundation-6',
        ],

    ],

    /* -----------------------------------------------------------------
     |  Route
     | -----------------------------------------------------------------
     */

    'home-route'    => 'public::home',

];
```
