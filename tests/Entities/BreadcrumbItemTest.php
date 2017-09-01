<?php namespace Arcanedev\Breadcrumbs\Tests\Entities;

use Arcanedev\Breadcrumbs\Entities\BreadcrumbItem;
use Arcanedev\Breadcrumbs\Tests\TestCase;

/**
 * Class BreadcrumbItemTest
 * @package Arcanedev\Breadcrumbs\Tests\Entities
 */
class BreadcrumbItemTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var BreadcrumbItem */
    private $breadcrumb;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function tearDown()
    {
        unset($this->breadcrumb);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $title            = 'Home';
        $url              = 'http://www.example.com';
        $this->breadcrumb = new BreadcrumbItem(compact('title', 'url'));

        $this->assertInstanceOf(BreadcrumbItem::class, $this->breadcrumb);

        $this->assertSame($title, $this->breadcrumb->getTitle());
        $this->assertSame($title, $this->breadcrumb->title);

        $this->assertSame($url, $this->breadcrumb->getUrl());
        $this->assertSame($url, $this->breadcrumb->url);

        $this->assertFalse($this->breadcrumb->isFirst());
        $this->assertFalse($this->breadcrumb->first);

        $this->assertFalse($this->breadcrumb->isLast());
        $this->assertFalse($this->breadcrumb->last);
    }

    /** @test */
    public function it_can_make()
    {
        $title            = 'Home';
        $url              = 'http://www.example.com';
        $this->breadcrumb = BreadcrumbItem::make($title, $url);

        $this->assertInstanceOf(BreadcrumbItem::class, $this->breadcrumb);

        $this->assertSame($title, $this->breadcrumb->getTitle());
        $this->assertSame($title, $this->breadcrumb->title);

        $this->assertSame($url, $this->breadcrumb->getUrl());
        $this->assertSame($url, $this->breadcrumb->url);

        $this->assertFalse($this->breadcrumb->isFirst());
        $this->assertFalse($this->breadcrumb->first);

        $this->assertFalse($this->breadcrumb->isLast());
        $this->assertFalse($this->breadcrumb->last);
    }

    /** @test */
    public function it_can_set_and_get_custom_data()
    {
        $this->breadcrumb = new BreadcrumbItem($attributes = [
            'title' => 'Home',
            'url'   => 'http://www.example.com',
            'class' => 'active',
            'style' => 'display: block;',
        ]);

        $this->assertSame($attributes['class'], $this->breadcrumb->extra('class'));
        $this->assertSame($attributes['style'], $this->breadcrumb->extra('style'));

        $this->assertNull($this->breadcrumb->extra('target'));
        $this->assertSame('_blank', $this->breadcrumb->extra('target', '_blank'));
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $breadcrumb = new BreadcrumbItem([
            'title' => 'Home',
            'url'   => 'http://www.example.com',
            'class' => 'active',
            'style' => 'display: block;',
        ]);

        $expected = [
            'title' => 'Home',
            'url'   => 'http://www.example.com',
            'extra' => [
                'class' => 'active',
                'style' => 'display: block;',
            ],
            'first' => false,
            'last'  => false,
        ];

        $this->assertSame($expected, $breadcrumb->toArray());
    }
}
