<?php
/*
 * This file is part of the `aop-io/php-aop` package.
 *
 * (c) Nicolas Tallefourtane <dev@nicolab.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code or visit http://aop.io
 *
 * @copyright Nicolas Tallefourtane <http://nicolab.net>
 */

namespace tests\units\Aop;

use
    mageekguy\atoum,
    Aop\Aop as _Aop,
    Aop\Exception\AopException
;

/**
 * Generic function to test
 * @param mixed $value
 * @return mixed
 */
function doGenericFunctionToTest($value)
{
    return $value;
}

/**
 * Generic function to test with throw exception
 *
 * @param mixed $value
 *
 * @throws AopException
 * @return mixed $value
 */
function doGenericFunctionToTestThrow($value)
{
    throw new AopException($value);

    return $value;
}

/**
 * Tests the majority of features through the main class.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class Aop extends atoum\test
{
    /**
     * @type _Aop
     */
    private $aop;

    /**
     * Used for test the kinds of property
     * @var mixed
     */
    private $tp;


    public function test__construct()
    {
        $this->aop = new _Aop(['test' => 'great!']);

        // options
        $this
            ->array( $this->aop->getOptions() )
                ->isNotEmpty()
                ->hasKey('php_interceptor')

            ->string( $this->aop->getOption('php_interceptor') )
                ->isNotEmpty()

            ->string( $this->aop->getOption('test') )
                ->isEqualTo('great!')

            ->boolean( $this->aop->hasOption('test') )
                ->isTrue()

            ->boolean( $this->aop->hasOption('not defined option') )
                ->isFalse()

            ->object( $this->aop->setOption('test2', 'value2') )
                ->isInstanceOf('\Aop\Aop')
                ->isIdenticalTo($this->aop)

            ->string( $this->aop->getOption('test2') )
                ->isEqualTo('value2')

            ->object( $this->aop->addOptions(['test3' => 'value3']) )
                ->isInstanceOf('\Aop\Aop')
                ->isIdenticalTo($this->aop)

            ->string( $this->aop->getOption('test3') )
                ->isEqualTo('value3')

            // test the singleton
            ->exception(function () {
                new _Aop();
            })
                ->isInstanceOf('\Aop\Exception\AopException')
        ;
    }

    public function test__callStatic()
    {
        $aop = new _Aop();

        $this
            ->object( _Aop::macro('hello', function ($name) {
                return $name;
            }))
                ->isEqualTo( $aop )

            // callstatic
            ->string(_Aop::hello('Nico'))
                ->isEqualTo('Nico')

            ->exception(function () {
                _Aop::notDefined('Nico');
            })
                ->isInstanceOf('\BadMethodCallException')
        ;

        // testMacro() is not called by atoum !?
        // then given that __callStatic() is associated with macro() we test the two here.
    }

    public function testMacro()
    {
        new _Aop();

        $this
            ->object( _Aop::macro('calc', function ($n) {
                return 2 + $n;
            }))
                // 8 + 2
                ->integer(_Aop::calc(8))
                ->isEqualTo(10)
        ;
    }

    public function testThis()
    {
        new _Aop();

        $this
            ->object( _Aop::this() )
                ->isInstanceOf('\Aop\KindConstantInterface');
    }

    public function testIsValidKind()
    {
        new _Aop();

        $this
            ->boolean( _Aop::isValidKind(-1000) )
                ->isFalse()

            ->boolean( _Aop::isValidKind(_Aop::KIND_BEFORE) )
                ->isTrue()

            ->boolean( _Aop::isValidKind('before') )
                ->isFalse()

            ->boolean( _Aop::isValidKind('beforeeeee') )
                ->isFalse()

            ->boolean( _Aop::isValidKind('before', false) )
                ->isTrue()
        ;
    }

    public function testIsKindBefore()
    {
        new _Aop();

        $kinds = _AOP::getKinds();

        foreach($kinds as $kind => $name) {

            if(substr($name, 0, strlen('before')) === 'before') {

                $this->boolean(_AOP::isKindBefore($kind))
                    ->isTrue();
            }else{
                $this->boolean(_AOP::isKindBefore($kind))
                    ->isFalse();
            }
        }
    }

    public function testIsKindAround()
    {
        new _Aop();

        $kinds = _AOP::getKinds();

        foreach($kinds as $kind => $name) {

            if(substr($name, 0, strlen('around')) === 'around') {

                $this->boolean(_AOP::isKindAround($kind))
                    ->isTrue();
            }else{
                $this->boolean(_AOP::isKindAround($kind))
                    ->isFalse();
            }
        }
    }

    public function testIsKindAfter()
    {
        new _Aop();

        $kinds = _AOP::getKinds();

        foreach($kinds as $kind => $name) {

            if(substr($name, 0, strlen('after')) === 'after') {

                $this->boolean(_AOP::isKindAfter($kind))
                    ->isTrue();
            }else{
                $this->boolean(_AOP::isKindAfter($kind))
                    ->isFalse();
            }
        }
    }

    public function testGetKindName()
    {
        new _Aop();

        $this
            ->string( _Aop::getKindName(_Aop::KIND_AFTER_FUNCTION_RETURN) )
                ->isEqualTo('after_function_return')

            ->string( _Aop::getKindName(_Aop::KIND_AROUND_PROPERTY_READ, true) )
                ->isEqualTo('AroundPropertyRead')

            ->exception(function () {
                _Aop::getKindName(-1000);
            })
                ->isInstanceOf('\Aop\Exception\KindException')
        ;
    }

    public function testGetKinds()
    {
        new _Aop();

        $ref      = new \ReflectionClass('\Aop\KindConstantInterface');
        $refkinds = $ref->getConstants();
        $kinds    = [];

        foreach ($refkinds as $kName => $value) {

            $kinds['constants'][constant('\Aop\KindConstantInterface::'.$kName)] = $value;
            $kinds['names'][] = strtolower(substr($kName, mb_strlen('KIND_')));
        }

        $this
            ->array( _Aop::getKinds() )
                ->isNotEmpty()
                ->hasKey(_Aop::KIND_THROW)
                ->contains('throw')

                // check if all kinds is mapped
                ->hasSize(count($kinds['constants']))

                // check if all kinds values is correctly mapped
                ->hasKeys(array_reverse($kinds['constants']))

                // check if the kinds names is correctly mapped
                ->strictlyContainsValues($kinds['names'])
        ;
    }

    /**
     * Test:
     *   * Aop::isEnabled()
     *   * Aop::disable()
     *   * Aop::Enabled()
     */
    public function testStatus()
    {
        new _Aop();

        $idx = _Aop::addAround('**\Aop->doGenericMethodToTest()', function ($jp) {

            $this->string( $jp->getArgs()[0] )
                ->isEqualTo('origin');

            $jp->setArgs([0 => 'new value']);

            $this->string( $jp->getArgs()[0] )
                ->isEqualTo('new value');

            $jp->proceed();
        });

        $ret = $this->doGenericMethodToTest('origin');

        $this
            ->boolean(_Aop::isEnabled($idx))
                ->isTrue()
            ->string($ret)
                ->isEqualTo('new value')
        ;

        _Aop::disable($idx);

        $ret = $this->doGenericMethodToTest('origin');

        $this
            ->boolean(_Aop::isEnabled($idx))
                ->isFalse()

            ->string($ret)
                ->isEqualTo('origin')
        ;

        _Aop::enable($idx);

        $ret = $this->doGenericMethodToTest('origin');

        $this
            ->boolean(_Aop::isEnabled($idx))
                ->isTrue()

            ->string($ret)
                ->isEqualTo('new value')
        ;
    }

    /**
     * Test:
     *   * Aop::addBefore() method
     */
    public function testAddBefore()
    {
        new _Aop();

        # METHOD
        $this->doGenericJoinPoint([
            'selector'       => '**\Aop->doGenericMethodToTest()',
            'method_to_test' => 'doGenericMethodToTest',
            'test_return'    => false,
            'method'         => 'addBefore',
            'class'          =>  '\Aop\JoinPoint\BeforeMethodJoinPoint',
            'callback'       => function ($jp, $options) {

                $this
                    ->string($jp->getMethodName())
                        ->isEqualTo('doGenericMethodToTest')

                    ->array($jp->getArgs())
                        ->hasSize(1)
                        ->contains('origin')
                ;

                $jp->setArgs([0 => 'new_arg_value']);

                $this
                    ->array($jp->getArgs())
                        ->hasSize(1)
                        ->contains('new_arg_value')
                ;
            }
        ]);

        # FUNCTION
        $this->doGenericJoinPoint([
            'selector'         => '**\doGenericFunctionToTest()',
            'function_to_test' => 'tests\units\Aop\doGenericFunctionToTest',
            'test_function'    => true,
            'test_return'      => false,
            'method'           => 'addBefore',
            'class'            =>  '\Aop\JoinPoint\BeforeFunctionJoinPoint',
            'callback'         => function ($jp, $options) {

                $this
                    ->string($jp->getFunctionName())
                        ->isEqualTo('tests\units\Aop\doGenericFunctionToTest')

                    ->array($jp->getArgs())
                        ->hasSize(1)
                        ->contains('origin')
                ;

                $jp->setArgs([0 => 'new_arg_value']);

                $this
                    ->array($jp->getArgs())
                        ->hasSize(1)
                        ->contains('new_arg_value')
                ;
            }
        ]);
    }

    public function testAddAround()
    {
        new _Aop();

        # METHOD
        $lastIndex = $this->doGenericJoinPoint([
            'selector'       => '**\Aop->doGenericMethodToTest()',
            'method_to_test' => 'doGenericMethodToTest',
            'method'         => 'addAround',
            'class'          =>  '\Aop\JoinPoint\AroundMethodJoinPoint',

            'callback'       => function ($jp, $options) {

                $this
                    ->string($jp->getMethodName())
                        ->isEqualTo('doGenericMethodToTest');

                $jp->proceed();
                $jp->setReturnValue($options['opt1']);
            }
        ]);

        $idx = _Aop::addAround('**\Aop->doGenericMethodToTestThrow()', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AroundMethodJoinPoint')

                ->string($jp->getMethodName())
                    ->isEqualTo('doGenericMethodToTestThrow')

                ->array($jp->getArgs())
                    ->hasSize(1)
                    ->contains('origin error')
            ;

            $jp->setArgs([0 => 'new error']);

            $this
                ->array($jp->getArgs())
                    ->hasSize(1)
                    ->contains('new error')

                ->array($options)
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string($options['opt1'])
                    ->isEqualTo('val1')
            ;

            try {
                $jp->proceed();
            } catch (\Exception $e) {

                $jp->setReturnValue('new value');
            }

            throw new AopException('new error');

        }, ['opt1' => 'val1']);

        $this
            ->exception(function () {
                $this->doGenericMethodToTestThrow('origin error');
            })
                ->isInstanceOf('\Aop\Exception\AopException')

                // capture the new Exception() (unlike the afterThrow() method)
                ->hasMessage('new error')

            ->integer($idx)
                ->isEqualTo($lastIndex+1)
        ;

        # FUNCTION
        $lastIndex = $this->doGenericJoinPoint([
            'inc_index'        => $lastIndex++,
            'selector'         => '**\doGenericFunctionToTest()',
            'function_to_test' => 'tests\units\Aop\doGenericFunctionToTest',
            'test_function'    => true,
            'method'           => 'addAround',
            'class'            =>  '\Aop\JoinPoint\AroundFunctionJoinPoint',

            'callback'         => function ($jp, $options) {

                $this
                    ->string($jp->getFunctionName())
                        ->isEqualTo('tests\units\Aop\doGenericFunctionToTest');

                $jp->proceed();
                $jp->setReturnValue($options['opt1']);
            }
        ]);

        $idx = _Aop::addAround('**\doGenericFunctionToTestThrow()', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AroundFunctionJoinPoint')

                ->string($jp->getFunctionName())
                    ->isEqualTo('tests\units\Aop\doGenericFunctionToTestThrow')

                ->array($jp->getArgs())
                    ->hasSize(1)
                    ->contains('origin error')
            ;

            $jp->setArgs([0 => 'new error']);

            $this
                ->array($jp->getArgs())
                    ->hasSize(1)
                    ->contains('new error')

                ->array($options)
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string($options['opt1'])
                    ->isEqualTo('val1')
            ;

            try {
                $jp->proceed();
            } catch (\Exception $e) {

                $jp->setReturnValue('new value');
            }

            throw new AopException('new error');

        }, ['opt1' => 'val1']);

        $this
            ->exception(function () {
                doGenericFunctionToTestThrow('origin error');
        })
            ->isInstanceOf('\Aop\Exception\AopException')
            ->hasMessage('new error') // capture the new Exception() (unlike the afterThrow() method)

            ->integer($idx)
                ->isEqualTo($lastIndex+1)
        ;
    }

    public function testAddAfter()
    {
        new _Aop();

        # METHOD: return
        $this->doGenericJoinPoint([
            'selector'       => '**\Aop->doGenericMethodToTest()',
            'method_to_test' => 'doGenericMethodToTest',
            'method'         => 'addAfter',
            'class'          =>  '\Aop\JoinPoint\AfterMethodJoinPoint',
            'callback'       => function ($jp, $options) {

                $this
                    ->string($jp->getMethodName())
                        ->isEqualTo('doGenericMethodToTest');

                $jp->setReturnValue($options['opt1']);
            }
        ]);

        # METHOD: throw
        $this->addAfterWithThrow(
            'addAfter',
            '**\Aop->doGenericMethodToTestThrow()',
            '\Aop\JoinPoint\AfterMethodJoinPoint',
            false
        );

        # FUNCTION: throw
        $this->addAfterWithThrow(
            'addAfter',
            '**\doGenericFunctionToTestThrow()',
            '\Aop\JoinPoint\AfterFunctionJoinPoint',
            true
        );
    }

    public function testAddAfterThrow()
    {
        new _Aop();

        # METHOD
        $this->addAfterWithThrow(
            'addAfterThrow',
            '**\Aop->doGenericMethodToTestThrow()',
            '\Aop\JoinPoint\AfterMethodThrowJoinPoint',
            false
        );

        # FUNCTION: throw
        $this->addAfterWithThrow(
            'addAfterThrow',
            '**\doGenericFunctionToTestThrow()',
            '\Aop\JoinPoint\AfterFunctionThrowJoinPoint',
            true
        );
    }

    public function testAddAfterReturn()
    {
        new _Aop();

        $this->doGenericJoinPoint([
            'selector'       => '**\Aop->doGenericMethodToTest()',
            'method_to_test' => 'doGenericMethodToTest',
            'method'         => 'addAfterReturn',
            'class'          =>  '\Aop\JoinPoint\AfterMethodReturnJoinPoint',

            'callback'       => function ($jp, $options) {

                $this
                    ->string($jp->getMethodName())
                        ->isEqualTo('doGenericMethodToTest');

                $jp->setReturnValue($options['opt1']);
            }
        ]);
    }

    /**
     * Generic testing for each joinpoint
     * @param array $context
     */
    private function doGenericJoinPoint(array $context)
    {
        static $lastIndex;

        $lastIndex++;

        $context = array_replace(
            [
                'method_to_test'   => false,
                'function_to_test' => false,
                'test_function'    => false,
                'class'            => null,
                'method'           => null,
                'selector'         => '**\Aop->doGenericMethodToTest()',
                'options'          => ['opt1' => 'val1'],
                'test_return'      => true,
                'inc_index'        => 0,

                'callback'         => function ($jp, $options) {}
            ],
            $context
        );

        $lastIndex += $context['inc_index'];

        $index = _Aop::this()->$context['method'](

            $context['selector'],

            function ($jp, $options) use ($context) {

                $this
                    ->object( $jp )
                        ->isInstanceOf($context['class'])
                ;

                $this
                    ->array($options)
                        ->hasKey('opt1')
                        ->contains('val1')

                    ->string($options['opt1'])
                        ->isEqualTo('val1')
                ;

                if ($context['method_to_test']) {

                    $this->object( $jp->getReflectionMethod() )
                        ->isInstanceOf('\ReflectionMethod');

                    $this->object( $jp->getReflectionClass() )
                        ->isInstanceOf('\ReflectionClass');

                } elseif ($context['function_to_test']) {

                    $this->object( $jp->getReflectionFunction() )
                        ->isInstanceOf('\ReflectionFunction');
                }

                $context['callback']($jp, $options);
            },

            $context['options']
        );

        if ($context['method_to_test']) {

            $return = $this->$context['method_to_test']('origin');

        } elseif ($context['function_to_test']) {

            $return = $context['function_to_test']('origin');
        }

        $this->integer( $index )
            ->isEqualTo($lastIndex);

            if ($context['test_return']) {

                $this->string( $return )
                    ->isEqualTo('val1');
            }

        return $lastIndex;
    }

    private function addAfterWithThrow($addAfterMethod, $selector, $jpClass, $isFunction)
    {
        $jpAfter;

        $idx = _Aop::$addAfterMethod($selector, function ($jp, $options)
            use (&$jpAfter, $jpClass, $isFunction) {

            $this
                ->object($jp)
                    ->isInstanceOf($jpClass)

                ->array($jp->getArgs())
                    ->hasSize(1)
                    ->contains('origin error')
            ;

            if ($isFunction) {

                $this->string($jp->getFunctionName())
                    ->isEqualTo('tests\units\Aop\doGenericFunctionToTestThrow');

            } else {

                $this->string($jp->getMethodName())
                    ->isEqualTo('doGenericMethodToTestThrow');
            }

            $this
                ->array($options)
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string($options['opt1'])
                    ->isEqualTo('val1')

                ->object($jp->getException())
                    ->isInstanceOf('\Aop\Exception\AopException')

                ->string($jp->getException()->getMessage())
                    ->isEqualTo('origin error')
            ;

            $jpAfter = $jp;

            throw new AopException('new error');

        }, ['opt1' => 'val1']);

        $this
            ->exception(function () use ($isFunction) {

                if($isFunction) {
                    doGenericFunctionToTestThrow('origin error');
                } else {
                    $this->doGenericMethodToTestThrow('origin error');
                }
            })
                ->isInstanceOf('\Aop\Exception\AopException')

                // not capture the new Exception() (unlike the Around() method)
                ->hasMessage('origin error')

            ->integer($idx)
                ->isGreaterThanOrEqualTo(1)
        ;
    }

    public function testPropertyKinds()
    {
        new _Aop();

        # BEFORE
        $tpBeforeRead = _Aop::addBefore('read **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\BeforePropertyReadJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;
        }, ['opt1' => 'val1']);

        $tpBeforeWrite = _Aop::addBefore('write **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\BeforePropertyWriteJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;
        }, ['opt1' => 'val1']);

        $tpBefore = _Aop::addBefore('**\Aop->tp', function ($jp, $options) {

            // The "PECL AOP extension" triggers the joinpoints write and read for this.
            // the desired normal behavior would trigger "<the kind>PropertyJoinPoint",
            // like AfterMethodJoinPoint encompassing the behaviors "throw" and "return".
            // $this->object($jp)->isInstanceOf('\Aop\JoinPoint\BeforePropertyJoinPoint');
            $availables = [
                'Aop\JoinPoint\BeforePropertyReadJoinPoint',
                'Aop\JoinPoint\BeforePropertyWriteJoinPoint',
                'Aop\JoinPoint\BeforePropertyJoinPoint',
            ];

            $this
                ->object( $jp )
                    ->array( $availables )
                        ->contains($class = get_class($jp))

                ->object( $jp )
                    ->isInstanceOf($class)

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;

        }, ['opt1' => 'val1']);

        $this
            ->integer($tpBeforeRead)
                ->isEqualTo(1)

            ->integer($tpBeforeWrite)
                ->isEqualTo(2)

            ->integer($tpBefore)
                ->isEqualTo(3)
        ;

        # AROUND

        $tpAroundRead = _Aop::addAround('read **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AroundPropertyReadJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;

            $jp->proceed();

        }, ['opt1' => 'val1']);

        $tpAroundWrite = _Aop::addAround('write **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AroundPropertyWriteJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;

            $jp->proceed();

        }, ['opt1' => 'val1']);

        $tpAround = _Aop::addAround('**\Aop->tp', function ($jp, $options) {

            // The "PECL AOP extension" triggers the joinpoints write and read for this.
            // the desired normal behavior would trigger "<the kind>PropertyJoinPoint",
            // like AfterMethodJoinPoint encompassing the behaviors "throw" and "return".
            // $this->object($jp)->isInstanceOf('\Aop\JoinPoint\AroundPropertyJoinPoint');
            $availables = [
                'Aop\JoinPoint\AroundPropertyReadJoinPoint',
                'Aop\JoinPoint\AroundPropertyWriteJoinPoint',
                'Aop\JoinPoint\AroundPropertyJoinPoint',
            ];

            $this
                ->object( $jp )
                    ->array( $availables )
                    ->contains($class = get_class($jp))

                ->object( $jp )
                    ->isInstanceOf($class)

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;

            $jp->proceed();

        }, ['opt1' => 'val1']);

        $this
            ->integer($tpAroundRead)
                ->isEqualTo(4)

            ->integer($tpAroundWrite)
                ->isEqualTo(5)

            ->integer($tpAround)
                ->isEqualTo(6)
        ;

        # AFTER
        $tpAfterRead = _Aop::addAfter('read **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AfterPropertyReadJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;
        }, ['opt1' => 'val1']);

        $tpAfterWrite = _Aop::addAfter('write **\Aop->tp', function ($jp, $options) {

            $this
                ->object($jp)
                    ->isInstanceOf('\Aop\JoinPoint\AfterPropertyWriteJoinPoint')

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;
        }, ['opt1' => 'val1']);

        $tpAfter = _Aop::addAfter('**\Aop->tp', function ($jp, $options) {

            // The "PECL AOP extension" triggers the joinpoints write and read for this.
            // the desired normal behavior would trigger "<the kind>PropertyJoinPoint",
            // like AfterMethodJoinPoint encompassing the behaviors "throw" and "return".
            // $this->object($jp)->isInstanceOf('\Aop\JoinPoint\AfterPropertyJoinPoint');
            $availables = [
                'Aop\JoinPoint\AfterPropertyReadJoinPoint',
                'Aop\JoinPoint\AfterPropertyWriteJoinPoint',
                'Aop\JoinPoint\AfterPropertyJoinPoint',
            ];

            $this
                ->object( $jp )
                    ->array( $availables )
                    ->contains($class = get_class($jp))

                ->object( $jp )
                    ->isInstanceOf($class)

                ->string( $jp->getPropertyName() )
                    ->isEqualTo('tp')

                ->string( $jp->getClassName() )
                    ->isEqualTo('tests\units\Aop\Aop')

                ->object( $jp->getReflectionProperty() )
                    ->isInstanceOf('\ReflectionProperty')

                ->array( $options )
                    ->hasKey('opt1')
                    ->contains('val1')

                ->string( $options['opt1'] )
                    ->isEqualTo('val1')
            ;

        }, ['opt1' => 'val1']);

        $this
            ->integer($tpAfterRead)
                ->isEqualTo(7)

            ->integer($tpAfterWrite)
                ->isEqualTo(8)

            ->integer($tpAfter)
                ->isEqualTo(9);

        // triggers the kinds of property
        $this->tp = 'value';

        $read = function () {
            return $this->tp;
        };

        $read();
    }

    public function testWeaver()
    {
        new _Aop();

        $weaver = _Aop::this()->getWeaver();

        $this
            ->object($weaver)
                ->isInstanceOf('\Aop\Weaver\WeaverInterface')
                ->boolean($weaver->isEnabled())

            ->object($weaver->getInterceptor())
                ->isInstanceOf('\Aop\Weaver\Interceptor')
        ;
    }

    /**
     * Generic method to test
     * @param mixed $value
     */
    private function doGenericMethodToTest($value)
    {
        return $value;
    }

    /**
     * Generic method to test with throw exception
     * @param mixed $value
     */
    private function doGenericMethodToTestThrow($value)
    {
        throw new AopException($value);

        return $value;
    }
}
