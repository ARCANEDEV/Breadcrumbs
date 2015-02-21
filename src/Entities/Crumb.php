<?php namespace Arcanedev\Breadcrumbs\Entities;

class Crumb
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var string */
    protected $title;

    /** @var string */
    protected $url;

    /** @var bool */
    protected $first;

    /** @var bool */
    protected $last;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param string $title
     * @param string $url
     */
    function __construct($title, $url)
    {
        $this->setTitle($title);
        $this->setUrl($url);
        $this->first = false;
        $this->last  = false;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param  string $title
     *
     * @return Crumb
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
     * Set URL
     *
     * @param string $url
     *
     * @return Crumb
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function toArray()
    {

    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */


    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
}
