<?php namespace Arcanedev\Breadcrumbs\Tests\Entities;

use Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection;
use Arcanedev\Breadcrumbs\Tests\TestCase;

/**
 * Class     BreadcrumbCollectionTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbCollectionTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\Breadcrumbs\Entities\BreadcrumbCollection */
    private $bcCollection;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->bcCollection = new BreadcrumbCollection();
    }

    public function tearDown(): void
    {
        unset($this->bcCollection);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        static::assertInstanceOf(BreadcrumbCollection::class, $this->bcCollection);
        static::assertCount(0, $this->bcCollection);
    }

    /** @test */
    public function it_can_add_one()
    {
        static::assertCount(0, $this->bcCollection);

        $this->bcCollection->addOne('Home', 'http://www.example.com');

        static::assertCount(1, $this->bcCollection);
    }

    /** @test */
    public function it_can_order_items()
    {
        static::assertCount(0, $this->bcCollection);

        $this->bcCollection->addOne('Home', 'http://www.example.com');

        static::assertCount(1, $this->bcCollection);

        static::assertTrue($this->bcCollection->first()->isFirst());
        static::assertTrue($this->bcCollection->first()->isLast());

        $this->bcCollection->addOne('Products', 'http://www.example.com/products');

        static::assertCount(2, $this->bcCollection);

        static::assertTrue($this->bcCollection->first()->isFirst());
        static::assertFalse($this->bcCollection->first()->isLast());

        static::assertFalse($this->bcCollection->last()->isFirst());
        static::assertTrue($this->bcCollection->last()->isLast());

        $this->bcCollection->addOne('Product name', 'http://www.example.com/products/product-name');

        static::assertCount(3, $this->bcCollection);

        static::assertTrue($this->bcCollection->first()->isFirst());
        static::assertFalse($this->bcCollection->first()->isLast());

        static::assertFalse($this->bcCollection->get(1)->isFirst());
        static::assertFalse($this->bcCollection->get(1)->isLast());

        static::assertFalse($this->bcCollection->last()->isFirst());
        static::assertTrue($this->bcCollection->last()->isLast());
    }
}
