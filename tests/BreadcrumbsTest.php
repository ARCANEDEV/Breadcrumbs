<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Breadcrumbs;
use Arcanedev\Breadcrumbs\Builder;

class BreadcrumbsTest extends LaravelTestCase
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
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Breadcrumbs::class, $this->breadcrumbs);
    }

    /** @test */
    public function it_can_register_a_callback()
    {
        $this->breadcrumbs->register('blog', function(Builder $builder) {
            $builder->push('Home', 'http://www.example.com');
        });

        $this->assertNotEmpty($this->breadcrumbs->render('blog'));
    }

    /**
     * Call artisan command and return code.
     *
     * @param string $command
     * @param array  $parameters
     *
     * @return int
     */
    public function artisan($command, $parameters = [])
    {
        // TODO: Implement artisan() method.
    }
}
