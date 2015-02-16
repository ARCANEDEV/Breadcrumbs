<?php namespace Arcanedev\Breadcrumbs;

use Arcanedev\Breadcrumbs\Exceptions\InvalidBreadcrumbNameException;
use Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException;

class Builder
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    protected $callbacks  = [];

    /** @var array */
    protected $breadcrumbs = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct(array $callbacks)
    {
        $this->setCallbacks($callbacks);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get breadcrumbs
     *
     * @return array
     */
    public function get()
    {
        return $this->breadcrumbs;
    }

    /**
     * Set breadcrumbs
     *
     * @param array $breadcrumbs
     *
     * @return Builder
     */
    public function set(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;

        return $this;
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
     * @throws InvalidBreadcrumbNameException
     */
    public function call($name, $params)
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
     * @throws InvalidBreadcrumbNameException
     */
    public function parent($name)
    {
        $params = array_slice(func_get_args(), 1);
        $this->call($name, $params);
    }

    /**
     * Push a breadcrumb
     *
     * @param string      $title
     * @param string|null $url
     * @param array       $data
     */
    public function push($title, $url = null, array $data = [])
    {
        $breadcrumb = array_merge($data, [
            'title' => $title,
            'url'   => $url,
            'first' => false,
            'last'  => false,
        ]);

        $this->breadcrumbs[] = (object) $breadcrumb;
    }

    public function toArray()
    {
        $breadcrumbs = $this->breadcrumbs;
        // Add first & last indicators
        if ($breadcrumbs) {
            $breadcrumbs[0]->first = true;
            $breadcrumbs[count($breadcrumbs) - 1]->last = true;
        }
        return $breadcrumbs;
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
     * @throws InvalidBreadcrumbNameException
     */
    private function checkName($name)
    {
        if (! is_string($name)) {
            throw new InvalidTypeException(
                'The name value must be a string, ' . gettype($name) . ' given'
            );
        }

        if (! isset($this->callbacks[$name])) {
            throw new InvalidBreadcrumbNameException(
                'Breadcrumb not found with name "' . $name . '"'
            );
        }
    }
}
