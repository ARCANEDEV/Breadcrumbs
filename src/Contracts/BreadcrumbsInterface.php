<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Closure;

/**
 * Interface  BreadcrumbsInterface
 *
 * @package   Arcanedev\Breadcrumbs\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface BreadcrumbsInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Set default template view.
     *
     * @param  string  $template
     *
     * @return self
     */
    public function setTemplate($template);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
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
     * Render breadcrumbs items.
     *
     * @param  string|null  $name
     *
     * @return string
     */
    public function render($name = null);

    /**
     * Generate the breadcrumbs.
     *
     * @param  string $name
     *
     * @return array
     */
    public function generate($name);
}
