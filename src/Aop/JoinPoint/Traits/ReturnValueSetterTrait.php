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
 * Support the `\Aop\JoinPoint\Support\ReturnValueSetterSupportInterface`.
 *
 * @see \Aop\JoinPoint\Support\ReturnValueSetterSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReturnValueSetterTrait
{
    /**
     * @see \Aop\JoinPoint\Support\ReturnValueSetterSupportInterface::setReturnValue()
     */
    public function setReturnValue($value)
    {
        return $this->support->setReturnValue($value);
    }
}
