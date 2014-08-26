# Global Functions Mocker
A simple class that allow you mock global functions for your unit tests.

**Note**: This works only if you don't use absolute function calls (like ``\phpversion()``) in your classes.

## Installation
Add ``yguedidi/global-functions-mocker`` to the ``require-dev`` section of your ``composer.json``
```json
{
    "require-dev": {
        "yguedidi/global-functions-mocker": "*"
    }
}
```

## Basic usage
### 0 - Prerequisites
- [PHPUnit]
- [Mockery]

### 1 - Setup
First of all, call the ``GlobalFunctionsMocker::setUp()`` method in your test ``setUp()``  method.  
This is needed to clear mocked global functions between tests.

### 2 - Namespaced function
Create a function named **exactly** like the global function in the namespace of your tested class, but define it in your test file.  
The body of that function should be:
```php
return GlobalFunctionsMocker::execute('global_function_name', func_get_args());
```

### 3 - Mock the function
Then just mock the global function you need in your tests with ``GlobalFunctionsMocker::mock('global_function_name')``.  
It returns a subset of [Mockery\Expectation] so you can define some expectations: [MockedFunction]

## Full exemple
This exemple assume your tested class and your unit test class are in different namespace.
```php
// src/FooClass.php
namespace Acme\FooClass;

class FooClass {
    public function foo()
    {
        return phpversion();
    }
}
```
```php
// tests/FooClassTest.php

// Note the different namespace
namespace Acme\Tests\FooClass
{
    use Acme\FooClass;
    use YassineGuedidi\GlobalFunctionsMocker\GlobalFunctionsMocker as GFM;

    class FooClassTest extends \PHPUnit_Framework_TestCase
    {
        protected function setUp()
        {
            GFM::setUp()
        }

        public function testFoo()
        {
            GFM::mock('phpversion')->once()->withNoArgs()->andReturn('foo');
            $object = new FooClass();
            $this->assertEquals('foo', $object->foo());
        }
    }
}

// IMPORTANT: Define the function in the tested class namespace
namespace Acme\FooClass
{
    use YassineGuedidi\GlobalFunctionsMocker\GlobalFunctionsMocker as GFM;

    function phpversion()
    {
        // Don't forget 'func_get_args()' for fallback to the real global function work
        return GFM::execute('phpversion', func_get_args());
    }
}
```

## Reference
#### GlobalFunctionsMocker::mock($functionName)
Mock a global function. Should be called in your tests.

- **$functionName**  
Name of the global function to mock

#### GlobalFunctionsMocker::execute($functionName, $args)
Execute a mocked global function. Call this in your namespaced global function definition.

- **$functionName**  
Name of the global function to execute

- *$args* (optional)  
Arguments passed to the global function (empty array by default).  
**Important**: This should be ``func_get_args()`` in the namespaced function. It allow fallback to the real global if it's not mocked.

It will fallback to the real global function if the function isn't mocked by a test,
or if you mock it with some expectations but without a return value.

And if the real global function is not define (missing PHP extension for exemple), it will gracefully
throw a ``PHPUnit_Framework_SkippedTestError`` exception that will skip the current test with a
useful message.

#### MockedFunction
Available functions: with(), withArgs(), withNoArgs(), withAnyArgs(), andReturn(), andReturnValues(), andReturnUsing()
andReturnUndefined(), andReturnNull(), andThrow(),andThrowExceptions(),
zeroOrMoreTimes(), times(), never(), once(), twice(), atLeast(), atMost(), between().

Look at Mockery's documentation about [Expectation Declarations] and [Argument Validation] for more detail.

## License
See [LICENSE file]

[PHPUnit]: http://phpunit.de/
[Mockery]: https://github.com/padraic/mockery
[Mockery\Expectation]: https://github.com/padraic/mockery/blob/master/library/Mockery/Expectation.php
[MockedFunction]: src/MockedFunction.php
[Expectation Declarations]: http://docs.mockery.io/en/latest/reference/expectations.html
[Argument Validation]: http://docs.mockery.io/en/latest/reference/argument_validation.html
[LICENSE file]: LICENSE
