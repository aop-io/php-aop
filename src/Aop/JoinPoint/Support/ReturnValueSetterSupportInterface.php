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
 * ReturnValueSetterSupportInterface provides the accessor method
 * to set the return value of a callable (function or method) intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ReturnValueSetterSupportInterface
{
    /**
     * Set the value of the current callable intercepted.
     *
     * @param mixed $value The new value to return.
     */
    public function setReturnValue($value);
}
