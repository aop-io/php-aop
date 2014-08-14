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
 * ReturnValueGetterSupportInterface provides the accessor method
 * to get the returned value of a callable (function or method) intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ReturnValueGetterSupportInterface
{
    /**
     * Get the returned value by the current callable intercepted.
     *
     * If in an advice of kind `around` the method `getReturnValue()` is called before
     * the execution of the `proceed()` method, a `JoinPointException` is thrown.
     *
     * @return &mixed The value returned (by reference).
     */
    public function &getReturnValue();
}
