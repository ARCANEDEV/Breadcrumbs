<?php namespace Arcanedev\Breadcrumbs\Tests\Facades;

use Arcanedev\Breadcrumbs\Facades\Breadcrumbs;
use Arcanedev\Breadcrumbs\Tests\TestCase;

/**
 * Class     BreadcrumbsTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests\Laravel
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BreadcrumbsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_register_callbacks()
    {
        Breadcrumbs::register('public', function($builder) {
            //
        });
    }
}
