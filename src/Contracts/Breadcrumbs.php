<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Contracts;

use Closure;

/**
 * Interface  Breadcrumbs
 *
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
     * @param  array        $params
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render($name = null, ...$params);

    /**
     * Generate the breadcrumbs.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return array
     */
    public function generate($name, ...$params);
}
