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
 * ArgsGetterSupportInterface provides the accessor method to get the arguments values
 * of a callable (function or method) intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ArgsGetterSupportInterface
{
    /**
     * Get the arguments of the current callable intercepted.
     *
     * @return array An array of arguments.
     */
    public function getArgs();
}
