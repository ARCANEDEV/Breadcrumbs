<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Arcanedev\Breadcrumbs\Breadcrumbs;

interface BreadcrumbsContract
{
    /**
     * Register a domain
     *
     * @param string   $name
     * @param callable $callback
     *
     * @return Breadcrumbs
     */
    public function register($name, callable $callback);

    /**
     * @param  string $name
     *
     * @return array
     */
    public function generate($name);

    /**
     * @param  string $name
     * @param  array  $args
     *
     * @return array
     */
    public function generateArray($name, $args = []);

    /**
     * Render breadcrumbs
     *
     * @param string|null $name
     */
    public function render($name = null);
}
