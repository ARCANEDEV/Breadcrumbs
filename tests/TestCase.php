<?php namespace Arcanedev\Breadcrumbs\Tests;

use Orchestra\Testbench\TestCase as LaravelTestCase;

/**
 * Class TestCase
 * @package Arcanedev\Breadcrumbs\Tests
 */
abstract class TestCase extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register Service Providers
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Arcanedev\Breadcrumbs\Laravel\ServiceProvider'
        ];
    }

    /**
     * Register Aliases
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Breadcrumbs' => 'Arcanedev\Breadcrumbs\Laravel\Facade'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
    }
}
