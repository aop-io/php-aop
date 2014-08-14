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
namespace Aop\JoinPoint\Traits;

/**
 * Support `\Aop\JoinPoint\Support\ExceptionGetterSupportInterface`
 *
 * @see \Aop\JoinPoint\Support\ExceptionGetterSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ExceptionGetterTrait
{
    /**
     * @see \Aop\JoinPoint\Support\ExceptionGetterSupportInterface::getException()
     */
    public function getException()
    {
        return $this->support->getException();
    }
}
