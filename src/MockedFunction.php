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

use Mockery\CompositeExpectation;
use Mockery\Expectation;

/**
 * @internal
 *
 * @author Yassine Guedidi <yassine@guedidi.com>
 */
class MockedFunction
{
    /**
     * @var CompositeExpectation|Expectation
     */
    private $expectation;

    /**
     * @param CompositeExpectation|Expectation $expectation
     */
    public function __construct($expectation)
    {
        $this->expectation = $expectation;
    }

    /**
     * @return $this
     */
    public function with()
    {
        call_user_func_array(array($this->expectation, 'with'), func_get_args());

        return $this;
    }

    /**
     * @return $this
     */
    public function withArgs(array $args)
    {
        $this->expectation->withArgs($args);

        return $this;
    }

    /**
     * @return $this
     */
    public function withNoArgs()
    {
        $this->expectation->withNoArgs();

        return $this;
    }

    /**
     * @return $this
     */
    public function withAnyArgs()
    {
        $this->expectation->withAnyArgs();

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturn()
    {
        call_user_func_array(array($this->expectation, 'andReturn'), func_get_args());

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnValues(array $values)
    {
        $this->expectation->andReturnValues($values);

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnUsing()
    {
        call_user_func_array(array($this->expectation, 'andReturnUsing'), func_get_args());

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnUndefined()
    {
        $this->expectation->andReturnUndefined();

        return $this;
    }

    /**
     * @return $this
     */
    public function andReturnNull()
    {
        $this->expectation->andReturnNull();

        return $this;
    }

    /**
     * @return $this
     */
    public function andThrow($exception, $message = '', $code = 0, \Exception $previous = null)
    {
        $this->expectation->andThrow($exception, $message, $code, $previous);

        return $this;
    }

    /**
     * @return $this
     */
    public function andThrowExceptions(array $exceptions)
    {
        $this->expectation->andThrowExceptions($exceptions);

        return $this;
    }

    /**
     * @return $this
     */
    public function zeroOrMoreTimes()
    {
        $this->expectation->zeroOrMoreTimes();

        return $this;
    }

    /**
     * @return $this
     */
    public function times($limit = null)
    {
        $this->expectation->times($limit);

        return $this;
    }

    /**
     * @return $this
     */
    public function never()
    {
        $this->expectation->never();

        return $this;
    }

    /**
     * @return $this
     */
    public function once()
    {
        $this->expectation->once();

        return $this;
    }

    /**
     * @return $this
     */
    public function twice()
    {
        $this->expectation->twice();

        return $this;
    }

    /**
     * @return $this
     */
    public function atLeast()
    {
        $this->expectation->atLeast();

        return $this;
    }

    /**
     * @return $this
     */
    public function atMost()
    {
        $this->expectation->atMost();

        return $this;
    }

    /**
     * @return $this
     */
    public function between($minimum, $maximum)
    {
        $this->expectation->between($minimum, $maximum);

        return $this;
    }

}
