<?php

if ( ! function_exists('breadcrumbs')) {
    /**
     * Get the Breadcrumb instance.
     *
     * @return \Arcanedev\Breadcrumbs\Contracts\Breadcrumbs
     */
    function breadcrumbs() {
        return app(Arcanedev\Breadcrumbs\Contracts\Breadcrumbs::class);
    }
}
