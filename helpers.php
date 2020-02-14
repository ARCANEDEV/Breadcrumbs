<?php

declare(strict_types=1);

use Arcanedev\Breadcrumbs\Contracts\Breadcrumbs;

if ( ! function_exists('breadcrumbs')) {
    /**
     * Get the Breadcrumb instance.
     *
     * @return \Arcanedev\Breadcrumbs\Contracts\Breadcrumbs
     */
    function breadcrumbs(): Breadcrumbs {
        return app(Breadcrumbs::class);
    }
}
