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
namespace Aop;

use
    Aop\KindConstantInterface,
    Aop\Exception\AopException,
    Aop\Advice\AdviceInterface,
    Aop\Advice\LazyAdvice,
    Aop\Aspect\LazyAspect,
    Aop\Pointcut\PointcutInterface,
    Aop\Pointcut\Pointcut,
    Aop\Weaver\Weaver,
    Aop\Traits\OptionTrait
;

/**
 * Main class Aop.
 *
 * @inheritdoc
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class Aop implements KindConstantInterface
{
    use OptionTrait;

    /**
     * The registered macros.
     *
     * @var array
     */
    protected static $macros = [];

    /**
     * The weaver instance.
     *
     * @var \Aop\Weaver\Weaver
     */
    private static $weaver;

    /**
     * A representation object of the Aop class.
     *
     * @see Aop::this()
     * @var Aop
     */
    private static $obj;

    /**
     * All available kinds.
     *
     * @see \Aop\KindConstantInterface
     * @var array
     */
    private static $kinds = [

        // Generic
        self::KIND_THROW                 => 'throw',
        self::KIND_FUNCTION              => 'function',
        self::KIND_METHOD                => 'method',
        self::KIND_PROPERTY              => 'property',
        self::KIND_READ                  => 'read',
        self::KIND_WRITE                 => 'write',

        // Before
        self::KIND_BEFORE                => 'before',
        self::KIND_BEFORE_FUNCTION       => 'before_function',
        self::KIND_BEFORE_METHOD         => 'before_method',
        self::KIND_BEFORE_PROPERTY       => 'before_property',
        self::KIND_BEFORE_PROPERTY_READ  => 'before_property_read',
        self::KIND_BEFORE_PROPERTY_WRITE => 'before_property_write',

        // Around
        self::KIND_AROUND                => 'around',
        self::KIND_AROUND_FUNCTION       => 'around_function',
        self::KIND_AROUND_METHOD         => 'around_method',
        self::KIND_AROUND_PROPERTY       => 'around_property',
        self::KIND_AROUND_PROPERTY_READ  => 'around_property_read',
        self::KIND_AROUND_PROPERTY_WRITE => 'around_property_write',

        // After
        self::KIND_AFTER                 => 'after',
        self::KIND_AFTER_THROW           => 'after_throw',
        self::KIND_AFTER_RETURN          => 'after_return',
        self::KIND_AFTER_FUNCTION        => 'after_function',
        self::KIND_AFTER_FUNCTION_THROW  => 'after_function_throw',
        self::KIND_AFTER_FUNCTION_RETURN => 'after_function_return',
        self::KIND_AFTER_METHOD          => 'after_method',
        self::KIND_AFTER_METHOD_THROW    => 'after_method_throw',
        self::KIND_AFTER_METHOD_RETURN   => 'after_method_return',
        self::KIND_AFTER_PROPERTY        => 'after_property',
        self::KIND_AFTER_PROPERTY_READ   => 'after_property_read',
        self::KIND_AFTER_PROPERTY_WRITE  => 'after_property_write',
    ];

    /**
     * Constructor.
     *
     * The constructor is used only the first time to configure the AOP execution environment.
     * If the given interceptor is not defined,
     * then "PECL AOP interceptor" (\PeclAop\PeclAopInterceptor) is used by default.
     *
     * @param array $options An array of options, default values is:
     *                       * 'php_interceptor' => '\PeclAop\PeclAopInterceptor'
     *
     * @throws \Aop\Exception\AopException
     */
    public function __construct(array $options = [])
    {
        if (self::$obj) {

            throw new AopException(
                'You have a design error, the AOP environment is already loaded.
                To avoid unexpected errors, the AOP environment (and Aop instance)
                must be created once only.
                You can use Aop::this() for get the Aop instance.'
            );
        }

        $options = array_replace([ 'php_interceptor' => '\PeclAop\PeclAopInterceptor'], $options);

        $this->addOptions($options);

        self::$weaver = new Weaver(new $options['php_interceptor']());
        self::$obj    = &$this;
    }

    /**
     * Dynamically handle calls to the macros.
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed  Returns the result of the macro.
     */
    public static function __callStatic($method, array $parameters = [])
    {
        if (isset(static::$macros[$method])) {
            return call_user_func_array(static::$macros[$method], $parameters);
        }

        throw new \BadMethodCallException("Method {$method} does not exist.");
    }

    /**
     * Get the current instance.
     *
     * @return Aop Returns the current instance.
     */
    public static function this()
    {
        return self::$obj;
    }

    /**
     * Get the Weaver instance.
     *
     * @return \Aop\Weaver\WeaverInterface Returns the weaver instance.
     */
    public static function getWeaver()
    {
        return self::$weaver;
    }

    /**
     * Check if a given kind is valid.
     *
     * @see \Aop\KindConstantInterface
     * @param int $kind
     * @param bool $strict
     *                     * `true` (by default) to check the type (int)
     *                       and the existence (KindConstantInterface) of the kind.
     *
     *                     * `false` has the same behavior except that the $kind
     *                       can be the kind name (`string`).
     *
     * @return bool `true` if the kind is valid, `false` is the kind is invalid.
     */
    public static function isValidKind($kind, $strict = true)
    {
        if(true === $strict or is_int($kind))

            return array_key_exists($kind, self::$kinds);

        if(false === ($kind = array_search(strtolower($kind), self::$kinds)))

            return false;

        return array_key_exists($kind, self::$kinds);
    }

    /**
     * Check if a given kind is in the group `before` (`before_*`).
     *
     * <code>
     * 	Aop::isKindBefore( $advice->getKind() );
     * </code>
     *
     * @see \Aop\KindConstantInterface
     *
     * @param int $kind
     * @return bool
     */
    public static function isKindBefore($kind)
    {
        return ($kind >= static::KIND_BEFORE && $kind < static::KIND_AROUND);
    }

    /**
     * Check if a given kind is in the group `around` (`around*`).
     *
     * <code>
     * 	// true
     *  Aop::isKindAround( Aop::KIND_AROUND_FUNCTION );
     * </code>
     *
     * @see \Aop\KindConstantInterface
     *
     * @param int $kind
     * @return bool
     */
    public static function isKindAround($kind)
    {
        return ($kind >= static::KIND_AROUND && $kind < static::KIND_AFTER);
    }

    /**
     * Check if a given kind is in the group `after` (`after_*`).
     *
     * <code>
     * 	// true
     *  Aop::isKindAfter( Aop::KIND_AFTER_METHOD_THROW );
     * </code>
     * @see \Aop\KindConstantInterface
     *
     * @param int $kind
     * @return bool
     */
    public static function isKindAfter($kind)
    {
        return ($kind >= Aop::KIND_AFTER);
    }

    /**
     * Get the name of a given kind.
     *
     * @see \Aop\KindConstantInterface
     * @param  int   $kind
     * @param  bool $camelcase   `true` for get the name in `CamelCase`
     *                           (useful for the class name).
     *                           `false` (by default) for get the name in `snake_case`
     *                           (useful for make a selector helper).
     *
     * @return string            The kind name.
     * @throws \Aop\Exception\KindException
     */
    public static function getKindName($kind, $camelcase = false)
    {
        if (!static::isValidKind($kind)) {
            throw new Exception\KindException('The kind is invalid.');
        }

        if ($camelcase) {
            return str_replace(' ', '', ucwords(strtr(self::$kinds[$kind], '_', ' ')));
        }

        return self::$kinds[$kind];
    }

    /**
     * Get all kinds.
     *
     * @see \Aop\KindConstantInterface
     * @return array An array of kinds [(int) <kind value> => (string) <kind name>].
     */
    public static function getKinds()
    {
        return self::$kinds;
    }

    /**
     * @see \Aop\Weaver\WeaverInterface::isEnabled()
     * @param int|null $index
     * @param string|null $selector
     *
     * @return bool
     */
    public static function isEnabled($index = null, $selector = null)
    {
        return self::getWeaver()->isEnabled($index, $selector);
    }

    /**
     * @see \Aop\Weaver\WeaverInterface::enable()
     * @param int|null $index
     * @param string|null $selector
     * @return Aop The current instance.
     */
    public static function enable($index = null, $selector = null)
    {
        self::getWeaver()->enable($index, $selector);

        return self::this();
    }

    /**
     * @see \Aop\Weaver\WeaverInterface::disable()
     *
     * @param int|null $index
     * @param string|null $selector
     *
     * @return Aop The current instance.
     */
    public static function disable($index = null, $selector = null)
    {
        self::getWeaver()->disable($index, $selector);

        return self::this();
    }

    /**
     * Add before.
     *
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    public static function addBefore($selector, callable $callback,
                                     array $options = [],$kind = null, $name = null)
    {
        return self::_addInWeaver('addBefore', $selector, $callback, $options, $kind, $name);
    }

    /**
     * Add around.
     *
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    public static function addAround($selector, callable $callback,
                                     array $options = [], $kind = null, $name = null)
    {
        return self::_addInWeaver('addAround', $selector, $callback, $options, $kind, $name);
    }

    /**
     * Add after.
     *
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    public static function addAfter($selector, callable $callback,
                                    array $options = [], $kind = null, $name = null)
    {
        return self::_addInWeaver('addAfter', $selector, $callback, $options, $kind, $name);
    }

    /**
     * Add after throwing.
     *
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    public static function addAfterThrow($selector, callable $callback,
                                         array $options = [], $kind = null, $name = null)
    {
        return self::_addInWeaver('addAfterThrow', $selector, $callback, $options, $kind, $name);
    }

    /**
     * Add after returning.
     *
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    public static function addAfterReturn($selector, callable $callback,
                                          array $options = [], $kind = null, $name = null)
    {
        return self::_addInWeaver('addAfterReturn', $selector, $callback, $options, $kind, $name);
    }

    /**
     * Register a custom macro.
     *
     * @param string   $name
     * @param callable $macro
     *
     * @return \Aop\Aop
     */
    public static function macro($name, $macro)
    {
        static::$macros[$name] = $macro;

        return static::this();
    }

    /**
     * Resolve and add in the weaver.
     *
     * @param  string      $method   Method name.
     * @param  string      $selector The selector that triggers the `$callback`.
     * @param  callable    $callback The callable to execute.
     * @param  array       $options  Eventual options.
     * @param  int|null    $kind     If necessary, indicates the kind of advice.
     * @param  string|null $name     If necessary, indicates the name of advice.
     * @return int         Returns the index assigned.
     */
    private static function _addInWeaver($method, $selector, callable $callback,
                                         array $options = [], $kind = null, $name = null)
    {
        if(!$callback instanceof AdviceInterface) {
            $callback = new LazyAdvice($callback, $options, $kind, $name);
        }

        if(!$selector instanceof PointcutInterface) {
            $selector = new Pointcut($selector);
        }

        return self::$weaver->$method($selector, $callback, $options);
    }
}
