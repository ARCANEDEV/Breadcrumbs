<?php namespace Arcanedev\Breadcrumbs\Entities;

use Arcanedev\Support\Collection;

/**
 * Class     BreadcrumbCollection
 *
 * @package  Arcanedev\Breadcrumbs\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The breadcrumbs collection.
     *
     * @var array
     */
    protected $items = [];

    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Add a breadcrumb item to collection.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
     *
     * @return self
     */
    public function addOne($title, $url, array $data = [])
    {
        $breadcrumb = BreadcrumbItem::make($title, $url, $data);

        return $this->add($breadcrumb);
    }

    /**
     * Add a breadcrumb item to collection.
     *
     * @param  BreadcrumbItem  $breadcrumb
     *
     * @return self
     */
    public function add(BreadcrumbItem $breadcrumb)
    {
        $this->push($breadcrumb);

        return $this->order();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Order all breadcrumbs items.
     *
     * @return self
     */
    private function order()
    {
        $count = $this->count();

        $this->map(function (BreadcrumbItem $crumb, $key) use ($count) {
            $crumb->resetPosition();

            if ($key === 0) {
                $crumb->setFirst();
            }

            if ($key === ($count - 1)) {
                $crumb->setLast();
            }

            return $crumb;
        });

        return $this;
    }
}
