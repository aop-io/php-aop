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
 * ClassSupportInterface provides the generic methods to handle a PHP class intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ClassSupportInterface
{
    /**
     * Get name of the class intercepted.
     *
     * @return string The class name. If the class is declared in a namespace `getClassName()`
     * returns the full name of the class (with the namespace).
     */
    public function getClassName();

    /**
     * Get the instance of the object intercepted.
     *
     * @return object|null An instance of the object.
     *  If the join point does not belongs to an object, the `getObject()` method returns `null`.
     */
    public function getObject();

    /**
     * Create a new `ReflectionClass` instance of the class intercepted.
     * The `ReflectionClass` class reports information about the class (or object) intercepted.
     *
     * @see ClassSupportInterface::getReflectionClass()
     *
     * @return \ReflectionClass
     */
    public function createReflectionClass();

    /**
     * Get a `ReflectionClass` instance (singleton) of the class (or object) intercepted.
     * The `ReflectionClass` class reports information about the class (or object) intercepted.
     *
     * @see ClassSupportInterface::createReflectionClass()
     *
     * @param  bool $singleton            `true` (by default) to use the singleton design pattern
     *                                    (it avoids recreating a new instance for each call),
     *                                    `false` to create a new instance or update the singleton.
     *
     * @return \ReflectionClass
     */
    public function getReflectionClass($singleton = true);
}
