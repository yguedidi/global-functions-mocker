<?php

/*
 * This file is part of the Global Functions Mocker by Yassine Guedidi package.
 * 
 * (c) Yassine Guedidi <yassine@guedidi.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace YassineGuedidi\GlobalFunctionsMocker\Tests;

use YassineGuedidi\GlobalFunctionsMocker\MockedFunction;

/**
 * @author Yassine Guedidi <yassine@guedidi.com>
 */
class MockedFunctionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\CompositeExpectation
     */
    private $expectation;

    /**
     * @var MockedFunction 
     */
    private $function;
   
    protected function setUp()
    {
        $this->expectation = \Mockery::mock();
        $this->function    = new MockedFunction($this->expectation);
    }

    public function testThatWithWorks()
    {
        $this->expectation->shouldReceive('with')->with('foo', 'bar')->once();
        $this->function->with('foo', 'bar');
    }

    public function testThatWithArgsWorks()
    {
        $this->expectation->shouldReceive('withArgs')->with(array('foo', 'bar'))->once();
        $this->function->withArgs(array('foo', 'bar'));
    }

    public function testThatWithNoArgsWorks()
    {
        $this->expectation->shouldReceive('withNoArgs')->withNoArgs()->once();
        $this->function->withNoArgs();
    }

    public function testThatWithAnyArgsWorks()
    {
        $this->expectation->shouldReceive('withAnyArgs')->withNoArgs()->once();
        $this->function->withAnyArgs();
    }

    public function testThatAndReturnWorks()
    {
        $this->expectation->shouldReceive('andReturn')->with('foo', 'bar')->once();
        $this->function->andReturn('foo', 'bar');
    }

    public function testThatAndReturnValuesWorks()
    {
        $this->expectation->shouldReceive('andReturnValues')->with(array('foo', 'bar'))->once();
        $this->function->andReturnValues(array('foo', 'bar'));
    }

    public function testThatAndReturnUsingWorks()
    {
        $this->expectation->shouldReceive('andReturnUsing')->with('foo', 'bar')->once();
        $this->function->andReturnUsing('foo', 'bar');
    }

    public function testThatAndReturnUndefinedWorks()
    {
        $this->expectation->shouldReceive('andReturnUndefined')->withNoArgs()->once();
        $this->function->andReturnUndefined();
    }

    public function testThatAndReturnNullWorks()
    {
        $this->expectation->shouldReceive('andReturnNull')->withNoArgs()->once();
        $this->function->andReturnNull();
    }

    public function testThatAndThrowWorks()
    {
        $this->expectation->shouldReceive('andThrow')->with('foo', '', 0, null)->once();
        $this->function->andThrow('foo', '', 0, null);
    }

    public function testThatAndThrowExceptionsWorks()
    {
        $this->expectation->shouldReceive('andThrowExceptions')->with(array('foo', 'bar'))->once();
        $this->function->andThrowExceptions(array('foo', 'bar'));
    }

    public function testThatZeroOrMoreTimesWorks()
    {
        $this->expectation->shouldReceive('zeroOrMoreTimes')->withNoArgs()->once();
        $this->function->zeroOrMoreTimes();
    }

    public function testThatTimesWorks()
    {
        $this->expectation->shouldReceive('times')->with(7)->once();
        $this->function->times(7);
    }

    public function testThatNeverWorks()
    {
        $this->expectation->shouldReceive('never')->withNoArgs()->once();
        $this->function->never();
    }

    public function testThatOnceWorks()
    {
        $this->expectation->shouldReceive('once')->withNoArgs()->once();
        $this->function->once();
    }

    public function testThatTwiceWorks()
    {
        $this->expectation->shouldReceive('twice')->withNoArgs()->once();
        $this->function->twice();
    }

    public function testThatAtLeastWorks()
    {
        $this->expectation->shouldReceive('atLeast')->withNoArgs()->once();
        $this->function->atLeast();
    }

    public function testThatAtMostWorks()
    {
        $this->expectation->shouldReceive('atMost')->withNoArgs()->once();
        $this->function->atMost();
    }

    public function testThatBetweenWorks()
    {
        $this->expectation->shouldReceive('between')->with(7, 23)->once();
        $this->function->between(7, 23);
    }

}
