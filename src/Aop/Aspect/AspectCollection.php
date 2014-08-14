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
namespace Aop\Aspect;

use Aop\Collection;

/**
 * A collection (`\Aop\Collection`) of aspects.
 *
 * @see \Aop\Collection
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class AspectCollection extends Collection
{
    /**
     * Add an aspect in the `AspectCollection`.
     *
     * @param  \Aop\Aspect\AspectInterface  $aspect
     * @return \Aop\Aspect\AspectCollection The current instance.
     */
    public function add(AspectInterface $aspect)
    {
        $this->container[$aspect->getName()] = $aspect;

        return $this;
    }
}
