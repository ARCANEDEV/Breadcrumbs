<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Arcanedev\Breadcrumbs\Builder;
use Arcanedev\Breadcrumbs\Exceptions\InvalidBreadcrumbNameException;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException;

interface BuilderContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get breadcrumbs
     *
     * @return array
     */
    public function get();

    /**
     * Set breadcrumbs
     *
     * @param array $breadcrumbs
     *
     * @return Builder
     */
    public function set(array $breadcrumbs);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Call breadcrumb
     *
     * @param  string $name
     * @param  array  $params
     *
     * @throws InvalidTypeException
     * @throws InvalidBreadcrumbNameException
     */
    public function call($name, $params);

    /**
     * Call parent breadcrumb
     *
     * @param  string $name
     *
     * @throws InvalidTypeException
     * @throws InvalidBreadcrumbNameException
     */
    public function parent($name);

    /**
     * Push a breadcrumb
     *
     * @param string      $title
     * @param string|null $url
     * @param array       $data
     */
    public function push($title, $url = null, array $data = []);

    public function toArray();
}