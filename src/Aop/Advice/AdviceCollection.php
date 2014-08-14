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
namespace Aop\Advice;

use Aop\Collection;

/**
 * A collection (`\Aop\Collection`) of advices.
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
class AdviceCollection extends Collection
{
    /**
     * Add an advice in the `AdviceCollection`
     *
     * @param  \Aop\Advice\AdviceInterface  $advice     An advice instance.
     * @return \Aop\Advice\AdviceCollection             The current `AdviceCollection` instance.
     */
    public function add(AdviceInterface $advice)
    {
        $this->container[$advice->getName()] = $advice;

        return $this;
    }
}
