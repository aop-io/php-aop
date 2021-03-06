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
 * `\Aop\KindConstantInterface::KIND_AROUND_PROPERTY_READ` handled by the interceptor.
 *
 * @see \Aop\KindConstantInterface::KIND_AROUND_PROPERTY_READ
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class AroundPropertyReadJoinPoint extends AroundJoinPoint implements
    Support\ClassSupportInterface,
    Support\PropertySupportInterface
{
    use
        Traits\ClassTrait,
        Traits\PropertyTrait
    ;

    /**
     * @inheritdoc
     * @see \Aop\JoinPoint\Support\KindSupportInterface::getKind()
     */
    public function getKind()
    {
        return \Aop\KindConstantInterface::KIND_AROUND_PROPERTY_READ;
    }
}
