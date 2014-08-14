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
namespace Aop\JoinPoint\Support;

/**
 * FunctionSupportInterface provides the generic methods to handle a PHP function intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface FunctionSupportInterface
{
    /**
     * Get the name of the function intercepted.
     *
     * @return string The function name.
     */
    public function getFunctionName();

    /**
     * Create a new `ReflectionFunction` instance of the function intercepted.
     * The `ReflectionFunction` class reports information about the function intercepted.
     *
     * @see FunctionSupportInterface::getReflectionFunction()
     *
     * @return \ReflectionFunction
     */
    public function createReflectionFunction();

    /**
     * Get a `ReflectionFunction` instance (singleton) of the function intercepted.
     * The `ReflectionFunction` class reports information about the function intercepted.
     *
     * @see FunctionSupportInterface::createReflectionFunction()
     *
     * @param  bool $singleton            `true` (by default) to use the singleton design pattern
     *                                    (it avoids recreating a new instance for each call),
     *                                    `false` to create a new instance or update the singleton.
     *
     * @return \ReflectionFunction
     */
    public function getReflectionFunction($singleton = true);
}
