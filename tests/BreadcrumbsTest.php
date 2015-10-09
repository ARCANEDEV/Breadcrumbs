<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Breadcrumbs;
use Arcanedev\Breadcrumbs\Builder;

/**
 * Class     BreadcrumbsTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
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

        $this->breadcrumbs = breadcrumbs();

        $this->registerMainBreadcrumb();
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

    /** @test */
    public function it_can_render()
    {
        $result = $this->breadcrumbs->render('public');

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
    public function it_can_generate_items()
    {
        $items = $this->breadcrumbs->generate('public');

        $this->assertCount(1, $items);

        $item = $items[0];

        $this->assertArrayHasKey('title', $item);
        $this->assertArrayHasKey('url', $item);
        $this->assertArrayHasKey('first', $item);
        $this->assertArrayHasKey('last', $item);

        $this->assertEquals($item['title'], 'Home');
        $this->assertEquals($item['url'], 'http://www.example.com');
        $this->assertTrue($item['first']);
        $this->assertTrue($item['last']);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException
     * @expectedExceptionMessage  The default template name must be a string, NULL given.
     */
    public function it_must_throw_invalid_type_exception_on_template()
    {
        $this->breadcrumbs->setTemplate(null);
    }

    /**
     * @test
     *
     * @expectedException         \Arcanedev\Breadcrumbs\Exceptions\InvalidTemplateException
     * @expectedExceptionMessage  The template [material-design] is not supported.
     */
    public function it_must_throw_InvalidTemplateException_on_template()
    {
        $this->breadcrumbs->setTemplate('material-design');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register main breadcrumb domain.
     */
    private function registerMainBreadcrumb()
    {
        $this->breadcrumbs->register('public', function(Builder $builder) {
            $builder->push('Home', 'http://www.example.com');
        });
    }
}
