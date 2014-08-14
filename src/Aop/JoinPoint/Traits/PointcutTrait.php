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
 * Support `\Aop\JoinPoint\Support\PointcutSupportInterface`
 *
 * @see \Aop\JoinPoint\Support\PointcutSupportInterface
 * @see \Aop\Pointcut\PointcutInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait PointcutTrait
{
    /**
     * The pointcut that triggered the current JoinPoint.
     * @var \Aop\Pointcut\PointcutInterface
     */
    protected $pointcut;

    /**
     * @see \Aop\JoinPoint\Support\PointcutSupportInterface::getPointcut()
     */
    public function getPointcut()
    {
        return $this->pointcut;
    }
}
