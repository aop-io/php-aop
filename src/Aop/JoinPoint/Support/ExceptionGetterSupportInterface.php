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
 * ExceptionGetterSupportInterface provides the accessor method to get a PHP Exception intercepted.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface ExceptionGetterSupportInterface
{
    /**
     * Get the PHP Exception thrown and intercepted.
     *
     * @return \Exception The instance of the PHP Exception intercepted.
     */
    public function getException();
}
