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
 * Support `\Aop\JoinPoint\Support\ArgsSetterSupportInterface`
 *
 * @see \Aop\JoinPoint\Support\ArgsSetterSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ArgsSetterTrait
{
    /**
     * @see \Aop\JoinPoint\Support\ArgsSetterSupportInterface::setArgs()
     */
    public function setArgs(array $args)
    {
        return $this->support->setArgs($args);
    }
}
