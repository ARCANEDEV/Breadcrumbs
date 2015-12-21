<?php namespace Arcanedev\Breadcrumbs\Tests;

use Arcanedev\Breadcrumbs\Builder;

/**
 * Class     BuilderTest
 *
 * @package  Arcanedev\Breadcrumbs\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BuilderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var Builder */
    private $builder;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->builder = new Builder([
            'main' => function(Builder $builder) {
                $builder->push('Home', 'http://www.example.com');
            },
            'blog' => function(Builder $builder) {
                $builder->parent('main');
                $builder->push('Blog', 'http://www.example.com/blog');
            }
        ]);
    }

    public function tearDown()
    {
        unset($this->builder);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\Breadcrumbs\Contracts\Builder::class,
            \Arcanedev\Breadcrumbs\Builder::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->builder);
        }

        $this->assertArrayHasKey('main', $this->builder->getCallbacks());
        $this->assertArrayHasKey('blog', $this->builder->getCallbacks());
        $this->assertEmpty($this->builder->toArray());
    }

    /** @test */
    public function it_can_be_called()
    {
        $this->assertCount(0, $this->builder->get());

        $this->builder->call('blog');

        $this->assertCount(2, $this->builder->get());
    }

    /**
     * @test
     *
     * @expectedException        \Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException
     * @expectedExceptionMessage The name value must be a string, boolean given
     */
    public function it_must_throw_invalid_type_exception()
    {
        $this->builder->call(true);
    }

    /**
     * @test
     *
     * @expectedException        \Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException
     * @expectedExceptionMessage The callback name not found [random]
     */
    public function it_must_throw_invalid_callback_name_exception()
    {
        $this->builder->call('random', []);
    }
}
