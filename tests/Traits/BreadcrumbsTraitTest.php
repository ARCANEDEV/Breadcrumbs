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
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->registerRoutes();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_render_home_page_breadcrumbs()
    {
        $this->route('GET', 'public::home');

        $result = breadcrumbs()->render('public');

        $this->assertStringStartsWith(
            '<ul class="breadcrumb breadcrumb-top">',
            $result
        );

        $this->assertContains(
            '<li class="active">Home</li>',
            $result
        );
    }

    /** @test */
    public function it_can_render_about_page_breadcrumbs()
    {
        $this->route('GET', 'public::about');

        $result = breadcrumbs()->render('public');

        $this->assertStringStartsWith(
            '<ul class="breadcrumb breadcrumb-top">',
            $result
        );

        $this->assertContains(
            '<li class="active">Home</li>',
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

            $router->get('/', [
                'as'    => 'public::about',
                'uses'  => 'DummyController@about',
            ]);
        });
    }
}
