<?php namespace Arcanedev\Breadcrumbs\Traits;

use Arcanedev\Breadcrumbs\Builder;
use Arcanedev\Breadcrumbs\Facades\Breadcrumbs;

/**
 * Class     BreadcrumbsTrait
 *
 * @package  Arcanedev\Breadcrumbs\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo:    Complete the doc comments
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
    private $bcContainer    = 'public';

    /**
     * Breadcrumbs collection.
     *
     * @var array
     */
    private $bcItems    = [];

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set breadcrumbs container name.
     *
     * @param  string  $bcContainer
     *
     * @return self
     */
    public function setBcContainer($bcContainer)
    {
        $this->bcContainer = $bcContainer;

        return $this;
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
    public function registerBreadcrumbs($container, array $item = [])
    {
        $this->setBcContainer($container);

        if (empty($item)) {
            $item = [
                'title' => 'Home',
                'url'   => route(config('breadcrumbs.home-route', 'public::home'))
            ];
        }

        Breadcrumbs::register('main', function(Builder $bc) use ($item) {
            $bc->push($item['title'], $item['url']);
        });

        Breadcrumbs::register($container, function(Builder $bc) {
            $bc->parent('main');
        });
    }

    /**
     * Load all breadcrumbs.
     */
    public function loadBreadcrumbs()
    {
        Breadcrumbs::register($this->bcContainer, function(Builder $bc) {
            $bc->parent('main');

            // TODO: Refactor this
            if ( ! empty($this->bcItems)) {
                foreach ($this->bcItems as $crumb) {
                    if ( ! empty($crumb['url'])) {
                        $bc->push($crumb['title'], $crumb['url']);
                    }
                    else {
                        $bc->push($crumb['title']);
                    }
                }
            }
        });
    }

    /**
     * Add breadcrumb.
     *
     * @param  string  $title
     * @param  string  $route
     * @param  array   $slugs
     *
     * @return self
     */
    public function addBreadcrumb($title, $route = '', $slugs = [])
    {
        $url = ! empty($route)
            ? ( ! empty($slugs) ? route($route, $slugs) : route($route))
            : '';

        $this->bcItems[] = [
            'title' => $title,
            'url' => $url,
        ];

        return $this;
    }
}
