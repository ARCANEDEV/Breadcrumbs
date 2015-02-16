<?php namespace Arcanedev\Breadcrumbs\Tests;

abstract class LaravelTestCase extends \Orchestra\Testbench\TestCase
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
            'Facade' => 'Arcanedev\Breadcrumbs\Laravel\Facade'
        ];
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
    }
}
