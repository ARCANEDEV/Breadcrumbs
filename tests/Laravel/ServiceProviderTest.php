<?php namespace Arcanedev\Breadcrumbs\Tests\Laravel;

use Arcanedev\Breadcrumbs\Laravel\ServiceProvider;
use Arcanedev\Breadcrumbs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @var ServiceProvider
     */
    private $serviceProvider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->serviceProvider = new ServiceProvider($this->app);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->serviceProvider);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @test
     */
    public function it_can_get_what_package_provides()
    {
        // This is for 100% code converge
        $this->assertEquals([
            'arcanedev.breadcrumbs'
        ], $this->serviceProvider->provides());
    }
}
