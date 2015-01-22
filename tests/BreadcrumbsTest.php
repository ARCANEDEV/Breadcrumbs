<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Breadcrumbs;

class BreadcrumbsTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    const BREADCRUMBS_CLASS = 'Arcanedev\\Breadcrumbs\\Breadcrumbs';
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
    /**
     * @test
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(self::BREADCRUMBS_CLASS, $this->breadcrumbs);
    }
}
