<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Closure;

/**
 * Interface  BreadcrumbsInterface
 *
 * @package   Arcanedev\Breadcrumbs\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo:     Complete the doc comments
 */
interface BreadcrumbsInterface
{
    /**
     * Register a breadcrumb domain.
     *
     * @param  string    $name
     * @param  \Closure  $callback
     *
     * @return self
     */
    public function register($name, Closure $callback);

    /**
     * Generate the breadcrumbs.
     *
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
    public function generateArray($name, array $args = []);

    /**
     * Render breadcrumbs
     *
     * @param string|null $name
     */
    public function render($name = null);
}
