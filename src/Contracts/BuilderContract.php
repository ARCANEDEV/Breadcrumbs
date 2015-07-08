<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Arcanedev\Breadcrumbs\Builder;
use Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection;
use Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException;

interface BuilderContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get breadcrumbs collection
     *
     * @return BreadcrumbCollection
     */
    public function get();

    /**
     * Get callbacks
     *
     * @return array
     */
    public function getCallbacks();

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
     * @throws InvalidCallbackNameException
     */
    public function call($name, array $params = []);

    /**
     * Call parent breadcrumb
     *
     * @param  string $name
     *
     * @throws InvalidTypeException
     * @throws InvalidCallbackNameException
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