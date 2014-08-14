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
namespace Aop\Exception;

/**
 * AopException thrown if an error on AOP occurs.
 *
 * AopException is the base PHP Exception for all AOP exceptions.
 *
 * PHP AOP.io provides a set of standard exceptions.
 * All AOP exceptions are inherited from `AopException`.
 * So, in general way, you can test any AOP errors by AopException.
 *
 * `AopException` thrown directly only concerning the domains which are not handled
 * by the other AOP exception class.
 *
 * @see \Aop\Exception
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class AopException extends \Exception {}
