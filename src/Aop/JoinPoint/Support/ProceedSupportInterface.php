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
 * ProceedSupportInterface provides the method to proceed explicitly
 * to the execution of the callable (function or method) intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ProceedSupportInterface
{
    /**
     * The `proceed()` method allows you to explicitly launch the triggering of the item intercepted:
     * function, method or property operation (read / write).
     * The `proceed()` method will only be available for advice of kind `around`.
     *
     * @return mixed The value of the callable intercepted.
     */
    public function proceed();
}
