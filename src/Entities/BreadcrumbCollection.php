<?php namespace Arcanedev\Breadcrumbs\Entities;

use Illuminate\Support\Collection;

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
     * Add a breadcrumb item to collection
     *
     * @param  string $title
     * @param  string $url
     * @param  array  $data
     *
     * @return self
     */
    public function addOne($title, $url, array $data = [])
    {
        $breadcrumb = BreadcrumbItem::make($title, $url, $data);

        return $this->add($breadcrumb);
    }

    /**
     * Add a breadcrumb item to collection
     *
     * @param  BreadcrumbItem $breadcrumb
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
     * Order all breadcrumbs items
     *
     * @return self
     */
    private function order()
    {
        $this->each(function(BreadcrumbItem $breadcrumb, $key) {
            $breadcrumb->resetPosition();

            if ($key === 0) {
                $breadcrumb->setFirst();
            }

            if ($key === ($this->count() - 1)) {
                $breadcrumb->setLast();
            }

            return $breadcrumb;
        });

        return $this;
    }
}
