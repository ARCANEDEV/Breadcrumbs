<?php namespace Arcanedev\Breadcrumbs\Tests\Laravel;

use Arcanedev\Breadcrumbs\Builder;
use Arcanedev\Breadcrumbs\Laravel\Facade as Breadcrumbs;
use Arcanedev\Breadcrumbs\Tests\LaravelTestCase;
use Symfony\Component\DomCrawler\Crawler;

class FacadeTest extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Arcanedev\Breadcrumbs\Breadcrumbs */
    private $breadcrumbs;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->breadcrumbs = Breadcrumbs::register('main', function($builder) {
            /** @var Builder $builder */
            $builder->push('Home',     'www.my-website.com');
            $builder->push('About us', 'www.my-website.com/about-us');
        });
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
    public function it_register_callbacks()
    {
        $crawler = $this->getCrawler();
        $this->assertEquals(1, $crawler->count());
        $this->assertEquals(2, $crawler->children()->count());
    }

    /** @test */
    public function it_can_generate_array()
    {
        $bc = $this->breadcrumbs->generateArray('main');

        $this->assertEquals(2, count($bc));

        $this->assertTrue($bc[0]->first);
        $this->assertFalse($bc[0]->last);

        $this->assertFalse($bc[1]->first);
        $this->assertTrue($bc[1]->last);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function getCrawler()
    {
        return (new Crawler($this->breadcrumbs->render('main')))
            ->filter('ul.breadcrumb.breadcrumb-top');
    }
}
