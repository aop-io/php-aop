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
 * PointcutSupportInterface provides the accessor method to get the current point cut.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
interface PointcutSupportInterface
{
    /**
     * Get the point cut that triggered the join point.
     *
     * @return \Aop\Pointcut\PointcutInterface The Pointcut instance.
     */
    public function getPointcut();
}
