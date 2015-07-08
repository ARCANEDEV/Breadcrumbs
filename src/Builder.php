<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Contracts\BuilderContract;
use Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection;
use Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException;

class Builder implements BuilderContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    protected $callbacks  = [];

    /** @var BreadcrumbCollection */
    protected $breadcrumbs;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct(array $callbacks = [])
    {
        $this->breadcrumbs = new BreadcrumbCollection;
        $this->setCallbacks($callbacks);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get breadcrumbs collection
     *
     * @return BreadcrumbCollection
     */
    public function get()
    {
        return $this->breadcrumbs;
    }

    /**
     * Get callbacks
     *
     * @return array
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * Set callbacks
     *
     * @param  array $callbacks
     *
     * @return Builder
     */
    private function setCallbacks(array $callbacks)
    {
        $this->callbacks = $callbacks;

        return $this;
    }

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
    public function call($name, array $params = [])
    {
        $this->checkName($name);

        array_unshift($params, $this);
        call_user_func_array($this->callbacks[$name], $params);
    }

    /**
     * Call parent breadcrumb
     *
     * @param  string $name
     *
     * @throws InvalidTypeException
     * @throws InvalidCallbackNameException
     */
    public function parent($name)
    {
        $this->call($name, array_slice(func_get_args(), 1));
    }

    /**
     * Push a breadcrumb
     *
     * @param  string      $title
     * @param  string|null $url
     * @param  array       $data
     *
     * @return self
     */
    public function push($title, $url = null, array $data = [])
    {
        $this->breadcrumbs->addOne($title, $url, $data);

        return $this;
    }

    /**
     * Get
     * @return array
     */
    public function toArray()
    {
        return $this->breadcrumbs->toArray();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check Name
     *
     * @param  string $name
     *
     * @throws InvalidTypeException
     * @throws InvalidCallbackNameException
     */
    private function checkName($name)
    {
        if ( ! is_string($name)) {
            throw new InvalidTypeException(
                'The name value must be a string, ' . gettype($name) . ' given'
            );
        }

        if ( ! isset($this->callbacks[$name])) {
            throw new InvalidCallbackNameException(
                "The callback name not found [{$name}]"
            );
        }
    }
}
