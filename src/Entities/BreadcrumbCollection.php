<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Entities;

use Illuminate\Support\Collection;

/**
 * Class     BreadcrumbCollection
 *
 * @package  Arcanedev\Breadcrumbs\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbCollection extends Collection
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Add a breadcrumb item to collection.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
     *
     * @return $this
     */
    public function addOne($title, $url, array $data = [])
    {
        return $this->addBreadcrumb(
            BreadcrumbItem::make($title, $url, $data)
        );
    }

    /**
     * Add a breadcrumb item to collection.
     *
     * @param  \Arcanedev\Breadcrumbs\Entities\BreadcrumbItem  $item
     *
     * @return $this
     */
    public function addBreadcrumb(BreadcrumbItem $item)
    {
        return $this->push($item)->order();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Order all breadcrumbs items.
     *
     * @return $this
     */
    private function order()
    {
        $count = $this->count();

        $this->map(function (BreadcrumbItem $crumb, $key) use ($count) {
            $crumb->resetPosition();

            if ($key === 0)
                $crumb->setFirst();

            if ($key === ($count - 1))
                $crumb->setLast();

            return $crumb;
        });

        return $this;
    }
}
