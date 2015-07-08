<?php namespace Arcanedev\Breadcrumbs\Tests\Entities;

use Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection;
use Arcanedev\Breadcrumbs\Tests\TestCase;

class BreadcrumbCollectionTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var BreadcrumbCollection */
    private $bcCollection;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->bcCollection = new BreadcrumbCollection();
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->bcCollection);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(BreadcrumbCollection::class, $this->bcCollection);
        $this->assertCount(0, $this->bcCollection);
    }

    /** @test */
    public function it_can_add_one()
    {
        $this->assertCount(0, $this->bcCollection);

        $this->bcCollection->addOne('Home', 'http://www.example.com');

        $this->assertCount(1, $this->bcCollection);
    }

    /** @test */
    public function it_can_order_items()
    {
        $this->assertCount(0, $this->bcCollection);

        $this->bcCollection->addOne('Home', 'http://www.example.com');

        $this->assertCount(1, $this->bcCollection);

        $this->assertTrue($this->bcCollection->first()->isFirst());
        $this->assertTrue($this->bcCollection->first()->isLast());

        $this->bcCollection->addOne('Products', 'http://www.example.com/products');

        $this->assertCount(2, $this->bcCollection);

        $this->assertTrue($this->bcCollection->first()->isFirst());
        $this->assertFalse($this->bcCollection->first()->isLast());

        $this->assertFalse($this->bcCollection->last()->isFirst());
        $this->assertTrue($this->bcCollection->last()->isLast());

        $this->bcCollection->addOne('Product name', 'http://www.example.com/products/product-name');

        $this->assertCount(3, $this->bcCollection);

        $this->assertTrue($this->bcCollection->first()->isFirst());
        $this->assertFalse($this->bcCollection->first()->isLast());

        $this->assertFalse($this->bcCollection->get(1)->isFirst());
        $this->assertFalse($this->bcCollection->get(1)->isLast());

        $this->assertFalse($this->bcCollection->last()->isFirst());
        $this->assertTrue($this->bcCollection->last()->isLast());
    }
}
