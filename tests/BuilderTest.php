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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\Breadcrumbs\Builder */
    private $builder;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp(): void
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

    public function tearDown(): void
    {
        unset($this->builder);

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
            \Arcanedev\Breadcrumbs\Contracts\Builder::class,
            Builder::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->builder);
        }

        static::assertArrayHasKey('main', $this->builder->getCallbacks());
        static::assertArrayHasKey('blog', $this->builder->getCallbacks());
        static::assertEmpty($this->builder->toArray());
    }

    /** @test */
    public function it_can_be_called()
    {
        static::assertCount(0, $this->builder->get());

        $this->builder->call('blog');

        static::assertCount(2, $this->builder->get());
    }

    /** @test */
    public function it_must_throw_invalid_type_exception()
    {
        $this->expectException(\Arcanedev\Breadcrumbs\Exceptions\InvalidTypeException::class);
        $this->expectExceptionMessage('The name value must be a string, boolean given');

        $this->builder->call(true);
    }

    /** @test */
    public function it_must_throw_invalid_callback_name_exception()
    {
        $this->expectException(\Arcanedev\Breadcrumbs\Exceptions\InvalidCallbackNameException::class);
        $this->expectExceptionMessage('The callback name not found [random]');

        $this->builder->call('random', []);
    }
}
