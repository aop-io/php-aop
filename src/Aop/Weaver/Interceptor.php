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

namespace Aop\Weaver;

use
    Aop\Aop,
    Aop\Pointcut\PointcutInterface,
    Aop\JoinPoint\Support\JoinPointSupportInterceptorInterface
;

/**
 * AOP Abstraction Layer.
 * Base class for all PHP interceptors.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
abstract class Interceptor implements WeaverInterface
{
    /**
     * Last index assigned.
     * The first index assigned is the integer 1,
     * if no index was assigned then null is returned.
     *
     * @var int|null
     */
    protected $lastIndex;

    /**
     * @inheritdoc
     * @see \Aop\Weaver\WeaverInterface::getLastIndex()
     */
    public function getLastIndex()
    {
        return $this->lastIndex;
    }

    /**
     * Create a new instance of JoinPoint.
     * Note: The kind of `JoinPoint` class depends on the context execution.
     *
     * @param  int                                                              $kind
     *  The kind of `JoinPoint`.
     * @param  \Aop\Pointcut\PointcutInterface                                  $pointcut
     *  The pointcut that triggers the `JoinPoint`.
     * @param  \Aop\JoinPoint\Support\JoinPointSupportInterceptorInterface      $support
     *  The interceptor that support the JoinPoint
     *
     * @return \Aop\JoinPoint\JoinPoint
     *  Returns a `JoinPoint` instance, the class of `JoinPoint` depends on the `$kind`.
     */
    protected function createJoinPoint($kind,
                                       PointcutInterface $pointcut,
                                       JoinPointSupportInterceptorInterface $support)
    {
        // class name
        $jp = '\Aop\JoinPoint\\'.Aop::getKindName($kind, true).'JoinPoint';

        // create an instance of JointPoint (kind class resolved)
        return new $jp($pointcut, $support);
    }
}
