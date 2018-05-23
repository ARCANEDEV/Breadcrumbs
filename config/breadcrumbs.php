<?php

return [

    /* -----------------------------------------------------------------
     |  Template
     | -----------------------------------------------------------------
     */

    'template'  => [

        'default'   => \Arcanedev\Breadcrumbs\Breadcrumbs::DEFAULT_TEMPLATE,

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
