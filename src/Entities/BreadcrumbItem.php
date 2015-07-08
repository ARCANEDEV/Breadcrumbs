<?php namespace Arcanedev\Breadcrumbs\Entities;

/**
 * Class BreadcrumbItem
 * @package Arcanedev\Breadcrumbs\Entities
 *
 * @property string title
 * @property string url
 * @property bool   first
 * @property bool   last
 */
class BreadcrumbItem
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Breadcrumb title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Breadcrumb url
     *
     * @var string
     */
    protected $url   = '';

    /**
     * @var bool
     */
    protected $first = false;

    /**
     * @var bool
     */
    protected $last  = false;

    /**
     * @var array
     */
    protected $data = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct($title, $url, array $data = [])
    {
        $this->setTitle($title);
        $this->setUrl($url);
        $this->first = false;
        $this->last  = false;
        $this->data  = $data;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param  string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param  string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param  string $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        $value = null;

        if (property_exists($this, $name)) {
            $value = $this->$name;
        }
        elseif ($this->hasData($name)) {
            $value = $this->data[$name];
        }

        return $value;
    }

    /**
     * Set first
     *
     * @return self
     */
    public function setFirst()
    {
        $this->first = true;

        return $this;
    }

    /**
     * Set last
     *
     * @return $this
     */
    public function setLast()
    {
        $this->last = true;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param  string $title
     * @param  string $url
     * @param  array  $data
     *
     * @return self
     */
    public static function make($title, $url, array $data = [])
    {
        return new self($title, $url, $data);
    }

    /**
     * Reset position
     *
     * @return self
     */
    public function resetPosition()
    {
        $this->first = false;
        $this->last  = false;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check is first item
     *
     * @return bool
     */
    public function isFirst()
    {
        return $this->first;
    }

    /**
     * Check is last item
     *
     * @return bool
     */
    public function isLast()
    {
        return $this->last;
    }

    /**
     * Check has a custom data
     *
     * @param  string $name
     *
     * @return bool
     */
    private function hasData($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->data, [
            'title' => $this->title,
            'url'   => $this->url,
            'first' => $this->first,
            'last'  => $this->last,
        ]);
    }
}
