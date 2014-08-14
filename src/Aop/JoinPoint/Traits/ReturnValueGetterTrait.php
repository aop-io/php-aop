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
 * Support `\Aop\JoinPoint\Support\ReturnValueGetterSupportInterface`.
 *
 * @see \Aop\JoinPoint\Support\ReturnValueGetterSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReturnValueGetterTrait
{
    /**
     * @see \Aop\JoinPoint\Support\ReturnValueGetterSupportInterface::getReturnValue()
     */
    public function &getReturnValue()
    {
        return $this->support->getReturnValue();
    }
}
