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
 * KindSupportInterface provides the method to get the kind of the current interception.
 * The kind of JoinPoint depends on the context of the aspect.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface KindSupportInterface
{
    /**
     * Get the kind of JoinPoint.
     * This indicates the invocation context of an advice.
     *
     * @see \Aop\Aop::getKindName()
     * @see \Aop\Aop::getKinds()
     * @see \Aop\Aop::isValidKind()
     *
     * @return int The constant value (`\Aop\KindConstantInterface::KIND_*`).
     */
    public function getKind();
}
