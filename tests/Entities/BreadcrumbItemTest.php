<?php

declare(strict_types=1);

namespace Arcanedev\Breadcrumbs\Tests\Entities;

use Arcanedev\Breadcrumbs\Entities\BreadcrumbItem;
use Arcanedev\Breadcrumbs\Tests\TestCase;

/**
 * Class BreadcrumbItemTest
 * @package Arcanedev\Breadcrumbs\Tests\Entities
 */
class BreadcrumbItemTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $title      = 'Home';
        $url        = 'http://www.example.com';
        $breadcrumb = new BreadcrumbItem(compact('title', 'url'));

        static::assertInstanceOf(BreadcrumbItem::class, $breadcrumb);

        static::assertSame($title, $breadcrumb->getTitle());
        static::assertSame($title, $breadcrumb->title);

        static::assertSame($url, $breadcrumb->getUrl());
        static::assertSame($url, $breadcrumb->url);

        static::assertFalse($breadcrumb->isFirst());
        static::assertFalse($breadcrumb->first);

        static::assertFalse($breadcrumb->isLast());
        static::assertFalse($breadcrumb->last);
    }

    /** @test */
    public function it_can_make(): void
    {
        $title      = 'Home';
        $url        = 'http://www.example.com';
        $breadcrumb = BreadcrumbItem::make($title, $url);

        static::assertInstanceOf(BreadcrumbItem::class, $breadcrumb);

        static::assertSame($title, $breadcrumb->getTitle());
        static::assertSame($title, $breadcrumb->title);

        static::assertSame($url, $breadcrumb->getUrl());
        static::assertSame($url, $breadcrumb->url);

        static::assertFalse($breadcrumb->isFirst());
        static::assertFalse($breadcrumb->first);

        static::assertFalse($breadcrumb->isLast());
        static::assertFalse($breadcrumb->last);
    }

    /** @test */
    public function it_can_set_and_get_custom_data(): void
    {
        $breadcrumb = new BreadcrumbItem($attributes = [
            'title' => 'Home',
            'url'   => 'http://www.example.com',
            'class' => 'active',
            'style' => 'display: block;',
        ]);

        static::assertSame($attributes['class'], $breadcrumb->extra('class'));
        static::assertSame($attributes['style'], $breadcrumb->extra('style'));

        static::assertNull($breadcrumb->extra('target'));
        static::assertSame('_blank', $breadcrumb->extra('target', '_blank'));
    }

    /** @test */
    public function it_can_convert_to_array(): void
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

        static::assertSame($expected, $breadcrumb->toArray());
    }
}
