<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\Builder as BuilderContract;

/**
 * Class     Builder
 *
 * @package  Arcanedev\Breadcrumbs
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
     * @var Entities\BreadcrumbCollection
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
        $this->breadcrumbs = new Entities\BreadcrumbCollection;
        $this->setCallbacks($callbacks);
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get breadcrumbs collection.
     *
     * @return Entities\BreadcrumbCollection
     */
    public function get()
    {
        return $this->breadcrumbs;
    }

    /**
     * Get callbacks.
     *
     * @return array
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * Set callbacks.
     *
     * @param  array  $callbacks
     *
     * @return Builder
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
     * @return self
     *
     * @throws Exceptions\InvalidTypeException
     * @throws Exceptions\InvalidCallbackNameException
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
     *
     * @throws Exceptions\InvalidTypeException
     * @throws Exceptions\InvalidCallbackNameException
     */
    public function parent($name)
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
     * @return self
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
    public function toArray()
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
     * @throws Exceptions\InvalidTypeException
     * @throws Exceptions\InvalidCallbackNameException
     */
    private function checkName($name)
    {
        if ( ! is_string($name)) {
            throw new Exceptions\InvalidTypeException(
                'The name value must be a string, ' . gettype($name) . ' given'
            );
        }

        if ( ! isset($this->callbacks[$name])) {
            throw new Exceptions\InvalidCallbackNameException(
                "The callback name not found [{$name}]"
            );
        }
    }
}
