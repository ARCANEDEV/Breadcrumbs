<?php namespace Arcanedev\Breadcrumbs\Tests\Laravel;

use Arcanedev\Breadcrumbs\Laravel\Facade as Breadcrumbs;
use Arcanedev\Breadcrumbs\Tests\LaravelTestCase;

class FacadeTest extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */

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
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_register_callbacks()
    {
        Breadcrumbs::register('public', function($builder) {

        });
    }
}
