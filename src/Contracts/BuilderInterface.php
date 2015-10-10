<?php namespace Arcanedev\Breadcrumbs\Contracts;

/**
 * Interface  BuilderInterface
 *
 * @package   Arcanedev\Breadcrumbs\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface BuilderInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters and Setters
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Call breadcrumb.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return self
     *
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException
     */
    public function call($name, array $params = []);

    /**
     * Call parent breadcrumb.
     *
     * @param  string  $name
     *
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException
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

    /**
     * Get the breadcrumbs items as a plain array.
     *
     * @return array
     */
    public function toArray();
}
