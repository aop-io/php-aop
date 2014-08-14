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
namespace Aop\Advice;

use Aop\JoinPoint\JoinPoint;

/**
 * The advice called by the weaver to satisfy an aspect.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface AdviceInterface
{
    /**
     * Invoke the advice.
     * This is the bootstrap of the advice.
     *
     * @param \Aop\JoinPoint\JoinPoint $jp A `JoinPoint` instance, the kind of `JoinPoint`
     *                                     depends on the context of the aspect.
     */
    public function __invoke(JoinPoint $jp);

    /**
     * Get kind of advice.
     * This indicates the invocation context of an advice.
     *
     * @see \Aop\KindConstantInterface
     * @see \Aop\Aop::getKindName()
     * @see \Aop\Aop::getKinds()
     * @see \Aop\Aop::isValidKind()
     *
     * @return int  The constant value (`\Aop\KindConstantInterface::KIND_*`) of kind.
     *              Returns `null` if the advice is generic
     *              or not have a dependency related to the context.
     */
    public function getKind();

    /**
     * Get name of the advice.
     *
     * @return string The name of the advice. If `null` the name is the object hash.
     */
    public function getName();

    /**
     * Check if the advice has the option `$name`.
     *
     * @param  string $name The option name to check if exists.
     * @return bool
     */
    public function hasOption($name);

    /**
     * Get an option of the advice.
     *
     * @param  string $name The name of the option.
     * @return mixed  The option value.
     */
    public function getOption($name);

    /**
     * Set an option in the advice.
     *
     * @param string $name  The name of the option.
     * @param string $value The value of the option.
     */
    public function setOption($name, $value);

    /**
     * Add options in the advice.
     *
     * @param array $options    An array of options of the advice
     *                          [(string) <option name> => (mixed)<option value>, ...].
     */
    public function addOptions(array $options);

    /**
     * Get all options of the advice in an array.
     *
     * @return array    An array of options of the advice
     *                  [(string) <option name> => (mixed)<option value>, ...].
     */
    public function getOptions();
}
