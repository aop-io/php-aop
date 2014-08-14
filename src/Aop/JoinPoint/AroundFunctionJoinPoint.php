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

namespace Aop\JoinPoint;

/**
 * Provides an abstraction layer of `JoinPoint` of kind
 * `\Aop\KindConstantInterface::KIND_AROUND_FUNCTION` handled by the interceptor.
 *
 * @see \Aop\KindConstantInterface::KIND_AROUND_FUNCTION
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class AroundFunctionJoinPoint extends AroundJoinPoint implements
    Support\FunctionSupportInterface,
    Support\ArgsGetterSupportInterface,
    Support\ArgsSetterSupportInterface,
    Support\ReturnValueGetterSupportInterface,
    Support\ReturnValueSetterSupportInterface
{
    use
        Traits\FunctionTrait,
        Traits\ArgsGetterTrait,
        Traits\ArgsSetterTrait,
        Traits\ReturnValueGetterTrait,
        Traits\ReturnValueSetterTrait
    ;

    /**
     * @inheritdoc
     * @see \Aop\JoinPoint\Support\KindSupportInterface::getKind()
     */
    public function getKind()
    {
        return \Aop\KindConstantInterface::KIND_AROUND_FUNCTION;
    }
}
