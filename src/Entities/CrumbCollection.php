<?php namespace Arcanedev\Breadcrumbs\Entities;

use Illuminate\Support\Collection;

class CrumbCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $items = [];

    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param array $breadcrumbs
     */
    public function load(array $breadcrumbs)
    {
        foreach($breadcrumbs as $breadcrumb) {

        }

        return $this;
    }

    /**
     * @param  string $title
     * @param  string $url
     *
     * @return CrumbCollection
     */
    public function add($title, $url)
    {
        $this->push(new Crumb($title, $url));

        return $this;
    }

    /**
     * @param  Crumb $crumb
     *
     * @return CrumbCollection
     */
    public function set(Crumb $crumb)
    {
        $this->push($crumb);

        return $this;
    }
}
