<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Tests\Stubs\Controllers\DummyController;
use Illuminate\Routing\Router;

/**
 * Class     HasBreadcrumbsTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HasBreadcrumbsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->setupRoutes($this->app['router']);
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_render_about_us_page_breadcrumbs(): void
    {
        $this->get(route('public::about-us'))
             ->isOk();

        $result = breadcrumbs()->render('public');

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $result);

        static::assertStringStartsWith(
            '<ol class="breadcrumb">',
            $result->toHtml()
        );

        static::assertStringContainsString(
            '<a href="http://localhost">Home</a>',
            $result->toHtml()
        );

        static::assertStringContainsString(
            '<a href="http://localhost/about">About</a>',
            $result->toHtml()
        );

        static::assertStringContainsString(
            '<li class="breadcrumb-item active" aria-current="page">ARCANEDEV</li>',
            $result->toHtml()
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Setup the routes.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    private function setupRoutes(Router $router): void
    {
        $router->name('public::')->group(function () use ($router) {
            $router->get('/', [DummyController::class, 'index'])
                   ->name('home');

            $router->get('about', [DummyController::class, 'about'])
                   ->name('about');

            $router->get('about-us', [DummyController::class, 'aboutUs'])
                   ->name('about-us');
        });
    }
}
