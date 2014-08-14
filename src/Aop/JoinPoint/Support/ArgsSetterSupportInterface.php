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
 * ArgsSetterSupportInterface provides the accessor method to set the arguments values
 * of a callable (function or method) intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ArgsSetterSupportInterface
{
    /**
     * Set the arguments of the current callable intercepted.
     * Note: if you want to keep references, you will have to explicitly pass them back
     * to `setArgs()` method.
     *
     * @param array $args An array with the new values of arguments.
     */
    public function setArgs(array $args);
}
