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
 * Support `\Aop\JoinPoint\Support\MethodSupportInterface`.
 * This trait provides a reflector for the `JoinPoint` classes of kind `method`.
 *
 * @see \Aop\JoinPoint\Support\MethodSupportInterface
 *
 * @author Nicolas Tallefourtane <dev@nicolab.net>
 */
trait ReflectionMethodTrait
{
    /**
     * @see \Aop\JoinPoint\Support\MethodSupportInterface::createReflectionMethod()
     */
    public function createReflectionMethod()
    {
        if($obj = $this->getObject()) {
            return new \ReflectionMethod($obj, $this->getMethodName());
        }

        return new \ReflectionMethod($this->getClassName(), $this->getMethodName());
    }

    /**
     * @see \Aop\JoinPoint\Support\MethodSupportInterface::getReflectionMethod()
     */
    public function getReflectionMethod($singleton = true)
    {
        static $ref; // singleton

        if($singleton && $ref) {
            return $ref;
        }

        return $ref = $this->createReflectionMethod();
    }
}
