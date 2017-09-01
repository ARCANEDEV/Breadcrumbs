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
        $this->route('GET', 'public::about-us');

        $result = breadcrumbs()->render('public');

        $this->assertStringStartsWith(
            '<ul class="breadcrumb breadcrumb-top">',
            $result
        );

        $this->assertContains(
            '<a href="http://localhost">Home</a>',
            $result
        );

        $this->assertContains(
            '<a href="http://localhost/about">About</a>',
            $result
        );

        $this->assertContains(
            '<li class="active">ARCANEDEV</li>',
            $result
        );
    }

    private function registerRoutes()
    {
        /** @var \Illuminate\Routing\Router $router */
        $router = app('router');

        $router->group([
            'namespace' => 'Arcanedev\\Breadcrumbs\\Tests\\Stubs'
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
