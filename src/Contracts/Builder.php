<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Contracts;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Interface  Builder
 *
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Builder extends Arrayable
{
    /* -----------------------------------------------------------------
     |  Getters and Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get breadcrumbs collection.
     *
     * @return \Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection
     */
    public function get();

    /**
     * Get breadcrumbs callbacks.
     *
     * @return array
     */
    public function getCallbacks();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Call breadcrumb.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return self
     */
    public function call($name, array $params = []);

    /**
     * Call parent breadcrumb.
     *
     * @param  string  $name
     */
    public function parent($name);

    /**
     * Push a breadcrumb.
     *
     * @param  string       $title
     * @param  string|null  $url
     * @param  array        $data
     */
    public function push($title, $url = null, array $data = []);
}
