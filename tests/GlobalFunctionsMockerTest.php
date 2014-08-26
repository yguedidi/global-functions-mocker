<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace YassineGuedidi\GlobalFunctionsMocker\Tests;

use YassineGuedidi\GlobalFunctionsMocker\GlobalFunctionsMocker;

/**
 * @author Yassine Guedidi <yassine@guedidi.com>
 */
class GlobalFunctionsMockerTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        GlobalFunctionsMocker::setUp();
    }

    public function testThatMockReturnsAMockedFunctionInstance()
    {
        $this->assertInstanceOf('YassineGuedidi\GlobalFunctionsMocker\MockedFunction', GlobalFunctionsMocker::mock('foo'));
    }

    /**
     * @expectedException PHPUnit_Framework_SkippedTestError
     * @expectedExceptionMessage foo() global function is not available.
     */
    public function testThatExecuteSkipTestWhenGlobalFunctionIsNotAvailableAndNotMocked()
    {
        GlobalFunctionsMocker::execute('foo');
    }

    public function testThatExecuteWorksWithNotMockedGlobalFunction()
    {
        $this->assertEquals(PHP_VERSION, GlobalFunctionsMocker::execute('phpversion'));
    }

    public function testThatExecuteWorksWithMockedGlobalFunctionWithoutReturnValue()
    {
        GlobalFunctionsMocker::mock('phpversion')->once()->withNoArgs();
        $this->assertEquals(PHP_VERSION, GlobalFunctionsMocker::execute('phpversion'));
    }

    public function testThatExecuteWorksWithMockedGlobalFunctionWithReturnValue()
    {
        GlobalFunctionsMocker::mock('phpversion')->once()->withNoArgs()->andReturn('foo');
        $this->assertEquals('foo', GlobalFunctionsMocker::execute('phpversion'));
    }

    /**
     * @expectedException PHPUnit_Framework_SkippedTestError
     * @expectedExceptionMessage foo() global function is not available.
     */
    public function testThatSetUpClearMockedFunctions()
    {
        GlobalFunctionsMocker::mock('foo')->andReturn('foo_result');
        $this->assertEquals('foo_result', GlobalFunctionsMocker::execute('foo'));

        GlobalFunctionsMocker::setUp();
        GlobalFunctionsMocker::execute('foo');
    }

}
