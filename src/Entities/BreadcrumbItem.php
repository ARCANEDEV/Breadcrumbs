<?php namespace Arcanedev\Breadcrumbs\Entities;

/**
 * Class     BreadcrumbItem
 *
 * @package  Arcanedev\Breadcrumbs\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string  title
 * @property  string  url
 * @property  bool    first
 * @property  bool    last
 */
class BreadcrumbItem
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Breadcrumb title.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Breadcrumb URL.
     *
     * @var string
     */
    protected $url   = '';

    /**
     * First position.
     *
     * @var bool
     */
    protected $first = false;

    /**
     * Last position.
     *
     * @var bool
     */
    protected $last  = false;

    /**
     * Custom data.
     *
     * @var array
     */
    protected $data = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a breadcrumb item instance.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
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
     * Get Title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param  string  $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get a breadcrumb item attribute.
     *
     * @param  string  $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        elseif ($this->hasData($name)) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     * Set as first item.
     *
     * @return self
     */
    public function setFirst()
    {
        $this->first = true;

        return $this;
    }

    /**
     * Set as last item.
     *
     * @return self
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
     * Make a breadcrumb item instance.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
     *
     * @return self
     */
    public static function make($title, $url, array $data = [])
    {
        return new self($title, $url, $data);
    }

    /**
     * Reset position.
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
     * Check is first item.
     *
     * @return bool
     */
    public function isFirst()
    {
        return $this->first;
    }

    /**
     * Check is last item.
     *
     * @return bool
     */
    public function isLast()
    {
        return $this->last;
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

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check if breadcrumb item has a custom data.
     *
     * @param  string $name
     *
     * @return bool
     */
    private function hasData($name)
    {
        return isset($this->data[$name]);
    }
}
