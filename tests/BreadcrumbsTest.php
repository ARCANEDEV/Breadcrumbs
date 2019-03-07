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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var Breadcrumbs */
    private $breadcrumbs;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
    {
        parent::setUp();

        $this->breadcrumbs = $this->app->make(\Arcanedev\Breadcrumbs\Contracts\Breadcrumbs::class);

        $this->registerMainBreadcrumb();
    }

    public function tearDown(): void
    {
        unset($this->breadcrumbs);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\Breadcrumbs\Contracts\Breadcrumbs::class,
            \Arcanedev\Breadcrumbs\Breadcrumbs::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->breadcrumbs);
        }
    }

    /** @test */
    public function it_can_be_instantiated_via_helper()
    {
        $this->breadcrumbs = breadcrumbs();

        $expectations = [
            \Arcanedev\Breadcrumbs\Contracts\Breadcrumbs::class,
            \Arcanedev\Breadcrumbs\Breadcrumbs::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->breadcrumbs);
        }
    }

    /** @test */
    public function it_can_render()
    {
        $result = $this->breadcrumbs->render('public');

        static::assertInstanceOf(\Illuminate\Support\HtmlString::class, $result);

        static::assertStringStartsWith(
            '<ol class="breadcrumb">',
            $result->toHtml()
        );

        static::assertStringContainsString(
            '<li class="breadcrumb-item active" aria-current="page">Home</li>',
            $result->toHtml()
        );
    }

    /** @test */
    public function it_can_generate_items()
    {
        $items = $this->breadcrumbs->generate('public');

        static::assertCount(1, $items);

        $item = $items[0];

        static::assertArrayHasKey('title', $item);
        static::assertArrayHasKey('url', $item);
        static::assertArrayHasKey('first', $item);
        static::assertArrayHasKey('last', $item);

        static::assertEquals($item['title'], 'Home');
        static::assertEquals($item['url'], 'http://www.example.com');
        static::assertTrue($item['first']);
        static::assertTrue($item['last']);
    }

    /** @test */
    public function it_must_throw_invalid_type_exception_on_template()
    {
        $this->expectException(\Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException::class);
        $this->expectExceptionMessage('The default template name must be a string, NULL given.');

        breadcrumbs()->setTemplate(null);
    }

    /** @test */
    public function it_must_throw_invalid_template_exception_on_not_found_template()
    {
        $this->expectException(\Arcanedev\Breadcrumbs\Exceptions\InvalidTemplateException::class);
        $this->expectExceptionMessage('The template [material-design] is not supported.');

        breadcrumbs()->setTemplate('material-design');
    }

    /** @test */
    public function it_must_throw_invalid_type_exception_on_register()
    {
        $this->expectException(\Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException::class);
        $this->expectExceptionMessage('The callback name value must be a string, NULL given.');

        breadcrumbs()->register(null, function () {
            return 'hello';
        });
    }

    /** @test */
    public function it_can_register_a_crumb_with_icon()
    {
        $this->breadcrumbs->register('public', function(Builder $builder) {
            $builder->push('Home', 'http://www.example.com', [
                'icon' => 'fa fa-home'
            ]);
        });

        static::assertStringContainsString(
            '<i class="fa fa-home"></i>',
            $this->breadcrumbs->render('public')->toHtml()
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
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
