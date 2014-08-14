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
 * MethodSupportInterface provides the generic methods to handle a class method intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface MethodSupportInterface
{
    /**
     * Get the name of the method intercepted.
     *
     * @return string The method name.
     */
    public function getMethodName();

    /**
     * Create a new `ReflectionMethod` instance of the method intercepted.
     * The `ReflectionMethod` class reports information about the method intercepted.
     *
     * @see MethodSupportInterface::getReflectionMethod()
     *
     * @return \ReflectionMethod
     */
    public function createReflectionMethod();

    /**
     * Get a `ReflectionMethod` instance (singleton) of the method intercepted.
     * The `ReflectionMethod` class reports information about the method intercepted.
     *
     * @see MethodSupportInterface::createReflectionMethod()
     *
     * @param  bool $singleton            `true` (by default) to use the singleton design pattern
     *                                    (it avoids recreating a new instance for each call),
     *                                    `false` to create a new instance or update the singleton.
     *
     * @return \ReflectionMethod
     */
    public function getReflectionMethod($singleton = true);
}
