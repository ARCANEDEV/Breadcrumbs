<?php namespace Arcanedev\Breadcrumbs\Tests\Traits;

use Arcanedev\Breadcrumbs\Tests\TestCase;
use Illuminate\Routing\Router;

/**
 * Class     BreadcrumbsTraitTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Traits
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsTraitTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->registerRoutes();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_render_about_us_page_breadcrumbs()
    {
        $this->get(route('public::about-us'))->isOk();

        $result = breadcrumbs()->render('public');

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $result);

        static::assertStringStartsWith(
            '<ol class="breadcrumb">',
            $result->toHtml()
        );

        static::assertContains(
            '<a href="http://localhost">Home</a>',
            $result->toHtml()
        );

        static::assertContains(
            '<a href="http://localhost/about">About</a>',
            $result->toHtml()
        );

        static::assertContains(
            '<li class="breadcrumb-item active" aria-current="page">ARCANEDEV</li>',
            $result->toHtml()
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    private function registerRoutes()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = app('router');

        $router->group([
            'namespace' => 'Arcanedev\\Breadcrumbs\\Tests\\Stubs\\Controllers'
        ], function (Router $router) {
            $router->get('/', [
                'as'    => 'public::home',
                'uses'  => 'DummyController@index',
            ]);

            $router->get('about', [
                'as'    => 'public::about',
                'uses'  => 'DummyController@about',
            ]);

            $router->get('about-us', [
                'as'    => 'public::about-us',
                'uses'  => 'DummyController@aboutUs',
            ]);
        });
    }
}
