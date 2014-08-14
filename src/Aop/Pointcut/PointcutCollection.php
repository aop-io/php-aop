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
namespace Aop\Pointcut;

use Aop\Collection;

/**
 * A collection (`\Aop\Collection`) of `Pointcut` instance.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class PointcutCollection extends Collection
{
    /**
     * Add a `Pointcut` in the `PointcutCollection`.
     *
     * @param  \Aop\Pointcut\PointcutInterface  $pointcut
     * @return PointcutCollection The current instance.
     */
    public function add(PointcutInterface $pointcut)
    {
        $this->container[$pointcut->getName()] = $pointcut;

        return $this;
    }
}
