<?php namespace Arcanedev\Breadcrumbs\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanedev\Breadcrumbs\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends BaseTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register Service Providers.
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class
        ];
    }

    /**
     * Register Aliases.
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Breadcrumbs' => \Arcanedev\Breadcrumbs\Facades\Breadcrumbs::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }
}
