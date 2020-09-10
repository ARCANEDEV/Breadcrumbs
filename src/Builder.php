<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\Builder as BuilderContract;
use Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection;

/**
 * Class     Builder
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Builder implements BuilderContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var array */
    protected $callbacks  = [];

    /**
     * Breadcrumbs collection.
     *
     * @var \Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection
     */
    protected $breadcrumbs;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create the builder instance.
     *
     * @param  array  $callbacks
     */
    public function __construct(array $callbacks = [])
    {
        $this->breadcrumbs = new BreadcrumbCollection;
        $this->setCallbacks($callbacks);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get breadcrumbs collection.
     *
     * @return \Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection
     */
    public function get(): BreadcrumbCollection
    {
        return $this->breadcrumbs;
    }

    /**
     * Get callbacks.
     *
     * @return array
     */
    public function getCallbacks(): array
    {
        return $this->callbacks;
    }

    /**
     * Set callbacks.
     *
     * @param  array  $callbacks
     *
     * @return $this
     */
    private function setCallbacks(array $callbacks)
    {
        $this->callbacks = $callbacks;

        return $this;
    }

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
     * @return $this
     */
    public function call($name, array $params = [])
    {
        $this->checkName($name);

        array_unshift($params, $this);
        call_user_func_array($this->callbacks[$name], $params);

        return $this;
    }

    /**
     * Call parent breadcrumb.
     *
     * @param  string  $name
     */
    public function parent($name): void
    {
        $this->call($name, array_slice(func_get_args(), 1));
    }

    /**
     * Push a breadcrumb.
     *
     * @param  string       $title
     * @param  string|null  $url
     * @param  array        $data
     *
     * @return $this
     */
    public function push($title, $url = null, array $data = [])
    {
        $this->breadcrumbs->addOne($title, $url, $data);

        return $this;
    }

    /**
     * Get the breadcrumbs items as a plain array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->breadcrumbs->toArray();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check Name.
     *
     * @param  string  $name
     *
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException
     * @throws \Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException
     */
    private function checkName($name): void
    {
        if ( ! is_string($name)) {
            throw new Exceptions\InvalidTypeException(
                'The name value must be a string, '.gettype($name).' given'
            );
        }

        if ( ! isset($this->callbacks[$name])) {
            throw new Exceptions\InvalidCallbackNameException(
                "The callback name not found [{$name}]"
            );
        }
    }
}
