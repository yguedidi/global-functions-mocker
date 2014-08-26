<?php

/*
 * This file is part of the Global Functions Mocker by Yassine Guedidi package.
 * 
 * (c) Yassine Guedidi <yassine@guedidi.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace YassineGuedidi\GlobalFunctionsMocker;

use Mockery;
use Mockery\Mock;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_SkippedTestError;
use YassineGuedidi\GlobalFunctionsMocker\MockedFunction;
use YassineGuedidi\GlobalFunctionsMocker\NoReturnValueException;

/**
 * A simple class that allow you mock global functions.
 *
 * @author Yassine Guedidi <yassine@guedidi.com>
 */
class GlobalFunctionsMocker
{
    /**
     * @var Mock Global functions mock container.
     */
    private static $globalFunctions;

    /**
     * @var string[] List of mocked global functions names.
     */
    private static $mockedFunctions;

    /**
     * Initialize mocked global functions.
     * Should be called in your test case setUp() function.
     */
    public static function setUp()
    {
        self::$globalFunctions = Mockery::mock();
        self::$mockedFunctions = array();
    }

    /**
     * Mock a global function.
     * Should be called in your tests.
     *
     * @param string $functionName Name of the global function to mock
     *
     * @return MockedFunction
     */
    public static function mock($functionName)
    {
        self::$mockedFunctions[] = $functionName;

        return new MockedFunction(
            self::$globalFunctions->shouldReceive($functionName)->andThrow(new NoReturnValueException())
        );
    }

    /**
     * Execute a mocked global function if available.
     * Call this in your namespaced global function definition.
     *
     * @param string $function Global function to call
     *
     * @return mixed
     *
     * @throws PHPUnit_Framework_SkippedTestError if the global function is not mocked and it's not available
     */
    public static function execute($function, array $parameters = array())
    {
        if (in_array($function, self::$mockedFunctions)) {
            try {
                return call_user_func_array([self::$globalFunctions, $function], $parameters);
            } catch (NoReturnValueException $e) {
                // No return value define in the mock, fallback to global function
            }
        }

        if (!function_exists('\\' . $function)) {
            PHPUnit_Framework_TestCase::markTestSkipped($function . '() global function is not available.');
        }

        return call_user_func_array('\\' . $function, $parameters);
    }

}
