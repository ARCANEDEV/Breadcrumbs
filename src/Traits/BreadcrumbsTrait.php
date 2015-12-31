<?php namespace Arcanedev\Breadcrumbs\Traits;

use Arcanedev\Breadcrumbs\Builder;

/**
 * Trait     BreadcrumbsTrait
 *
 * @package  Arcanedev\Breadcrumbs\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait BreadcrumbsTrait
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Breadcrumbs container name.
     *
     * @var string
     */
    protected $breadcrumbsContainer   = 'public';

    /**
     * Breadcrumbs items collection.
     *
     * @var array
     */
    private $breadcrumbsItems       = [];

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set breadcrumbs container name.
     *
     * @param  string  $name
     *
     * @return self
     */
    protected function setBreadcrumbsContainer($name)
    {
        $this->breadcrumbsContainer = $name;

        return $this;
    }

    /**
     * Get the breadcrumbs home item (root).
     *
     * @return array
     */
    protected function getBreadcrumbsHomeItem()
    {
        $route = config('breadcrumbs.home-route', 'public::home');

        return [
            'title' => 'Home',
            'url'   => route($route),
            'data'  => [],
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register a breadcrumb.
     *
     * @param  string  $container
     * @param  array   $item
     */
    protected function registerBreadcrumbs($container, array $item = [])
    {
        $this->setBreadcrumbsContainer($container);

        breadcrumbs()->register('main', function(Builder $bc) use ($item) {
            if (empty($item)) {
                $item = $this->getBreadcrumbsHomeItem();
            }

            $bc->push($item['title'], $item['url'], isset($item['array']) ? $item['array'] : []);
        });
    }

    /**
     * Load all breadcrumbs.
     */
    protected function loadBreadcrumbs()
    {
        breadcrumbs()->register($this->breadcrumbsContainer, function(Builder $bc) {
            $bc->parent('main');

            if ( ! empty($this->breadcrumbsItems)) {
                foreach ($this->breadcrumbsItems as $crumb) {
                    $bc->push($crumb['title'], $crumb['url'], isset($crumb['array']) ? $crumb['array'] : []);
                }
            }
        });
    }

    /**
     * Add breadcrumb.
     *
     * @param  string  $title
     * @param  string  $url
     * @param  array   $data
     *
     * @return self
     */
    protected function addBreadcrumb($title, $url = '', array $data = [])
    {
        $this->breadcrumbsItems[] = compact('title', 'url', 'data');

        return $this;
    }

    /**
     * Add breadcrumb with route.
     *
     * @param  string  $title
     * @param  string  $route
     * @param  array   $parameters
     * @param  array   $data
     *
     * @return self
     */
    protected function addBreadcrumbRoute($title, $route, array $parameters = [], array $data = [])
    {
        return $this->addBreadcrumb($title, route($route, $parameters), $data);
    }
}
