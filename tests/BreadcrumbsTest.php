<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Breadcrumbs;

class BreadcrumbsTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Breadcrumbs */
    private $breadcrumbs;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->breadcrumbs = new Breadcrumbs;
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->breadcrumbs);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Breadcrumbs::class, $this->breadcrumbs);
    }


}
