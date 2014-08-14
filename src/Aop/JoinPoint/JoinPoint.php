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

use Aop\Pointcut\PointcutInterface;

/**
 * Base class for all `JoinPoint` abstraction layers.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
abstract class JoinPoint implements Support\KindSupportInterface, Support\PointcutSupportInterface
{
    use Traits\PointcutTrait;

    /**
     * The support of the current `JoinPoint`, the kind of `JoinPoint` (and class)
     * depends on the context invocation.
     *
     * @var \Aop\JoinPoint\Support\JoinPointSupportInterceptorInterface
     */
    protected $support;

    /**
     * Constructor.
     *
     * @param \Aop\Pointcut\PointcutInterface $pointcut
     *  The pointcut that triggered the current `JoinPoint`.
     *
     * @param \Aop\JoinPoint\Support\JoinPointSupportInterceptorInterface $support
     *  The `JoinPoint` support of the used interceptor.
     */
    public function __construct(PointcutInterface $pointcut,
                                Support\JoinPointSupportInterceptorInterface $support)
    {
        $this->pointcut = $pointcut; // provided by Traits\PointcutTrait
        $this->support  = $support;
    }
}
