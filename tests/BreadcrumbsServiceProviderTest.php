<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider;

/**
 * Class     BreadcrumbsServiceProviderTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\Breadcrumbs\BreadcrumbsServiceProvider */
    private $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(BreadcrumbsServiceProvider::class);
    }

    public function tearDown(): void
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Illuminate\Contracts\Support\DeferrableProvider::class,
            \Arcanedev\Support\Providers\ServiceProvider::class,
            \Arcanedev\Support\Providers\PackageServiceProvider::class,
            BreadcrumbsServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides(): void
    {
        $expected = [
            \Arcanedev\Breadcrumbs\Contracts\Breadcrumbs::class,
        ];

        static::assertEquals($expected, $this->provider->provides());
    }
}
