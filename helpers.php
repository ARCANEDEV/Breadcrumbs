<?php

if ( ! function_exists('breadcrumbs')) {
    /**
     * Get the Breadcrumb instance.
     *
     * @return \Arcanedev\Breadcrumbs\Contracts\BreadcrumbsInterface
     */
    function breadcrumbs() {
        return app('arcanedev.breadcrumbs');
    }
}
