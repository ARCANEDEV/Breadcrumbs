<?php namespace Arcanedev\Breadcrumbs\Contracts;

use Closure;

/**
 * Interface  Breadcrumbs
 *
 * @package   Arcanedev\Breadcrumbs\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Breadcrumbs
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the supported template.
     *
     * @param  array  $supported
     *
     * @return self
     */
    public function setSupported(array $supported);

    /**
     * Set default template view.
     *
     * @param  string  $template
     *
     * @return self
     */
    public function setTemplate($template);

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
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
