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
        $this->breadcrumb = new BreadcrumbItem($title, $url);

        $this->assertInstanceOf(BreadcrumbItem::class, $this->breadcrumb);

        $this->assertEquals($title, $this->breadcrumb->getTitle());
        $this->assertEquals($title, $this->breadcrumb->title);

        $this->assertEquals($url, $this->breadcrumb->getUrl());
        $this->assertEquals($url, $this->breadcrumb->url);

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

        $this->assertEquals($title, $this->breadcrumb->getTitle());
        $this->assertEquals($title, $this->breadcrumb->title);

        $this->assertEquals($url, $this->breadcrumb->getUrl());
        $this->assertEquals($url, $this->breadcrumb->url);

        $this->assertFalse($this->breadcrumb->isFirst());
        $this->assertFalse($this->breadcrumb->first);

        $this->assertFalse($this->breadcrumb->isLast());
        $this->assertFalse($this->breadcrumb->last);
    }

    /** @test */
    public function it_can_set_and_get_custom_data()
    {
        $title            = 'Home';
        $url              = 'http://www.example.com';
        $data             = [
            'class' => 'active',
            'style' => 'display: block;',
        ];

        $this->breadcrumb = new BreadcrumbItem($title, $url, $data);

        $this->assertEquals($data['class'], $this->breadcrumb->class);
        $this->assertEquals($data['style'], $this->breadcrumb->style);
        $this->assertNull($this->breadcrumb->target);
    }

    /** @test */
    public function it_can_convert_to_array()
    {
        $title            = 'Home';
        $url              = 'http://www.example.com';
        $data             = [
            'class' => 'active',
            'style' => 'display: block;',
        ];

        $this->breadcrumb = BreadcrumbItem::make($title, $url, $data);

        $this->assertEquals(array_merge(
            compact('title', 'url'),
            ['first' => false, 'last' => false],
            $data
        ), $this->breadcrumb->toArray());
    }
}
