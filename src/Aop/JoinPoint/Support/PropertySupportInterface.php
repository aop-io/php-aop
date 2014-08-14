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
 * PropertySupportInterface provides the generic methods to handle a class property intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface PropertySupportInterface
{
    /**
     * Get the name of the current property intercepted.
     *
     * @return string The property name.
     */
    public function getPropertyName();

    /**
     * Create a new `ReflectionProperty` instance of the property intercepted.
     * The `ReflectionProperty` class reports information about the class property intercepted.
     *
     * @see PropertySupportInterface::getReflectionProperty()
     *
     * @return \ReflectionProperty
     */
    public function createReflectionProperty();

    /**
     * Get a `ReflectionProperty` instance of the property intercepted.
     * The `ReflectionProperty` class reports information about the class property intercepted.
     *
     * @see PropertySupportInterface::createReflectionProperty()
     *
     * @param  bool $singleton           `true` (by default) to use the singleton design pattern
     *                                   (it avoids recreating a new instance for each call),
     *                                   `false` to create a new instance or update the singleton.
     *
     * @return \ReflectionProperty
     */
    public function getReflectionProperty($singleton = true);
}
