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
namespace Aop\Aspect;

/**
 * An aspect is a set of concerns (point-cuts + advices).
 *
 * @see \Aop\Traits\OptionTrait
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface AspectInterface
{
    /**
     * Get the name of the aspect
     *
     * @return string The aspect name. Namespaced with "dot" notation
     *  and you can use the `snake_case` in the segments (eg: blog.last_comments).
     */
    public function getName();

    /**
     * Get a collection of all point-cuts handled by the current aspect.
     *
     * @see \Aop\Pointcut\PointcutCollection
     *
     * @return \Aop\Pointcut\PointcutCollection  A `PointcutCollection` instance
     */
    public function getPointcuts();

    /**
     * Get a collection of all advices handled by the current aspect.
     *
     * @see \Aop\Advice\AdviceCollection
     *
     * @return \Aop\Advice\AdviceCollection  An `AdviceCollection` instance
     */
    public function getAdvices();

    /**
     * Check if the aspect has the option `$name`.
     *
     * @param  string $name The option name to check if exists.
     * @return bool `true` if the aspect has the option `$name`, `false` otherwise.
     */
    public function hasOption($name);

    /**
     * Get an option of the aspect.
     *
     * @param  string $name The name of the option.
     * @return mixed  The option value.
     */
    public function getOption($name);

    /**
     * Set an aspect option.
     *
     * @param string $name  The name of the option.
     * @param string $value The value of the option.
     */
    public function setOption($name, $value);

    /**
     * Add options in the aspect.
     *
     * @param array $options An array of options
     *                       [(string) <option name> => (mixed)<option value>, ...].
     */
    public function addOptions(array $options);

    /**
     * Get all options of the aspect in an array.
     *
     * @return array An array of options [(string) <option name> => (mixed)<option value>, ...].
     */
    public function getOptions();
}
