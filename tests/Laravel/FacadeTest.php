<?php namespace Arcanedev\Breadcrumbs\Tests\Laravel;

use Breadcrumbs;
use Arcanedev\Breadcrumbs\Tests\TestCase;

class FacadeTest extends TestCase
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
