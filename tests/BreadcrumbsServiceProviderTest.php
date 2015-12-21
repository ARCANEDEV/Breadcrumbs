<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider;
use Arcanedev\Breadcrumbs\Tests\TestCase;

/**
 * Class     BreadcrumbsServiceProviderTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var BreadcrumbsServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(BreadcrumbsServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_must_be_a_provider()
    {
        $exceptedProviders = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider::class,
        ];

        foreach ($exceptedProviders as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_get_what_package_provides()
    {
        $this->assertEquals([
            'arcanedev.breadcrumbs'
        ], $this->provider->provides());
    }
}
