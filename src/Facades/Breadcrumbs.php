<?php namespace Arcanedev\Breadcrumbs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class     Breadcrumbs
 *
 * @package  Arcanedev\Breadcrumbs\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Breadcrumbs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'arcanedev.breadcrumbs'; }
}
